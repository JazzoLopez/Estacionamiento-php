    #include <DHT.h>
#define DHTPIN D4
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

void setup() {
 dht.begin();

}

void loop() {
    tempHum();
    
}

void tempHum(){
    delay(500);
    float h = dht.readHumidity();
    float t = dht.readTemperature();
    if(isnan(h) || isnan(t)){
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
