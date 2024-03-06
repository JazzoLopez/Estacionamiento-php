#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <DHT.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

// Proximidad
#define PIN_ECHO D2
#define PIN_TRIGGER D3
bool ocupado = false;

// Rutas yo configuracion de la conexion
#define SERVER_IP "172.16.2.113"
#define endpointProximidad "/dashboard/test/sensorEstacionamiento.php"
#define endpointSave "/dashboard/test/registrar/registrarFotoresistencia.php"
#define endpointUpdate "/dashboard/test/actualizar/actualizarFotoresistencia.php"
#define endpointDHT11 "/dashboard/test/sensorHumedad.php"
String serverPath = "";
const char *ssid = "Casa";
const char *password = "relojdearena1+";
unsigned long lastTime = 0;
const unsigned long timerDelay = 10000;

// Humedad
#define DHTTYPE DHT11
#define DHTPIN D4
DHT dht(DHTPIN, DHTTYPE);
float h, t;

// Fotoresistencia
int fotoceldaPin = A0; // variable fotocelda inicializada en 0 (se conectadara al pin análogo 0)
int fotoceldaVal = 0;  // Creación de una variable para guardar el valor que vaya leyendo la fotocelda
int led = D5;          // Variable para la luz led que se conectará al pin 9
bool estatus = false;

void setup()
{
  Serial.begin(9600);
  pinMode(fotoceldaPin, INPUT); // se declara el pin análogo 0 como entrada
  pinMode(led, OUTPUT);
  dht.begin();
  pinMode(PIN_TRIGGER, OUTPUT);
  pinMode(PIN_ECHO, INPUT);
  digitalWrite(PIN_TRIGGER, LOW);
  WiFi.begin(ssid, password);
  Serial.println("Connecting to network...");
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(1000);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("Connected to WiFi");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop()
{
  unsigned long currentTime = millis();
  if (currentTime - lastTime >= timerDelay)
  {
    SensorUltra();
    peticionHTTP();
    dht11();
    peticionDHT11();
    ldr();
    peticionLdr();
    lastTime = currentTime;
  }
}

void SensorUltra()
{
  digitalWrite(PIN_TRIGGER, HIGH);
  delayMicroseconds(10);
  digitalWrite(PIN_TRIGGER, LOW);

  unsigned long duration = pulseIn(PIN_ECHO, HIGH);
  float distance = duration * 0.034 / 2;

  Serial.print("Distance: ");
  Serial.print(distance);
  Serial.println(" cm");

  if (distance < 10)
  {
    ocupado = true;
  }
  else
  {
    ocupado = false;
  }
}

void peticionHTTP()
{
  WiFiClient client;
  HTTPClient http;

  if (WiFi.status() == WL_CONNECTED)
  {
    String serverPath = String("http://") + SERVER_IP + endpointProximidad + "?ocupado=" + String(ocupado ? 1 : 0) + "&cajon=1";
    Serial.print("Connecting to server: ");
    Serial.println(serverPath);

    if (http.begin(client, serverPath))
    {
      int httpCode = http.GET();
      if (httpCode > 0)
      {
        Serial.print("HTTP status: ");
        Serial.println(httpCode);
        String payload = http.getString();
        Serial.println("Response: ");
        Serial.println(payload);
      }
      else
      {
        Serial.print("HTTP error code: ");
        Serial.println(httpCode);
      }
      http.end();
    }
    else
    {
      Serial.println("Failed to connect to server");
    }
  }
  else
  {
    Serial.println("WiFi not connected");
  }
}

void dht11()
{
  delay(1000);
  h = dht.readHumidity();
  t = dht.readTemperature();
  if (isnan(h) || isnan(t))
  {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
  Serial.print("Humidity: ");
  Serial.print(h);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.println(" *C");
  delay(1000);
}

void peticionDHT11()
{
  WiFiClient client;
  HTTPClient http;

  if (WiFi.status() == WL_CONNECTED)
  {
    String serverPath = String("http://") + SERVER_IP + endpointDHT11 + "?temperatura=" + String(t) + "&humedad=" + String(h);
    Serial.print("Connecting to server: ");
    Serial.println(serverPath);

    if (http.begin(client, serverPath))
    {
      int httpCode = http.GET();
      if (httpCode > 0)
      {
        Serial.print("HTTP status: ");
        Serial.println(httpCode);
        String payload = http.getString();
        Serial.println("Response: ");
        Serial.println(payload);
      }
      else
      {
        Serial.print("HTTP error code: ");
        Serial.println(httpCode);
      }
      http.end();
    }
    else
    {
      Serial.println("Failed to connect to server");
    }
  }
  else
  {
    Serial.println("WiFi not connected");
  }
}

void ldr()
{
  fotoceldaVal = analogRead(fotoceldaPin); // Se le da a la variable fotoceldaVal el valor que vaya registrando el sensor fotocelda
  Serial.println(fotoceldaVal);
  if (fotoceldaVal < 400)
  {
    // condición para valorar el nivel de luz de la fotocelda
    digitalWrite(led, LOW);
    estatus = false;
  } // enciende la luz
  else if (fotoceldaVal > 400)
  {

    digitalWrite(led, HIGH); // apaga la luz led

    estatus = true;
  }
  delay(1000);
}

void peticionLdr()
{
  WiFiClient client;
  HTTPClient http;

  if (WiFi.status() == WL_CONNECTED)
  {
    if (estatus)
    {
      serverPath = String("http://") + SERVER_IP + endpointSave + "?estatus=" + String(estatus);
    }
    else
    {
      serverPath = String("http://") + SERVER_IP + endpointUpdate + "?estatus=" + String(estatus);
    }
    Serial.print("Connecting to server: ");
    Serial.println(serverPath);

    if (http.begin(client, serverPath))
    {
      int httpCode = http.GET();
      if (httpCode > 0)
      {
        Serial.print("HTTP status: ");
        Serial.println(httpCode);
        String payload = http.getString();
        Serial.println("Response: ");
        Serial.println(payload);
      }
      else
      {
        Serial.print("HTTP error code: ");
        Serial.println(httpCode);
      }
      http.end();
    }
    else
    {
      Serial.println("Failed to connect to server");
    }
  }
  else
  {
    Serial.println("WiFi not connected");
  }
}
