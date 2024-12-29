#include<ESP8266WiFi.h>
#include<WiFiClient.h>
#include<ESP8266HTTPClient.h>
#include<ArduinoJson.h>

//membuat variabel bernama key tipe data String
//untuk menyesuaikan field bernama token yang ada di
//database-->tujuan keamanan
String key="12345";
//membuat variabel bernama led1 dan led2
//karena nilainya kita atur read only artinya: pakai const
//const int led1=2; //GPIO2 kalau cek board nodemcu ada di D2
//atau pakai pin penamaan Digital
const int lampu=D1;

//koneksi ke access point
const char* wifiName = "-----";
const char* wifiPass = "------";

void setup() {
  //lampu sebagai OUTPUT
  pinMode(lampu, OUTPUT);

  Serial.begin(115200);
  delay(10);
  Serial.println();
  //buat koneksi ke access point
  WiFi.begin(wifiName, wifiPass);
  //untuk cek apakah terkoneksi ke access point atau tidak
  while(WiFi.status() != WL_CONNECTED){
    //akan dieksekusi terus menerus jika TRUE 
    //keluar dari while jika FALSE
    delay(500);
    Serial.print(".");
  }
  Serial.print("Terhubung ke ");
  Serial.println(wifiName);
  //perlihatkan ip address
  Serial.println("IP Address:");
  Serial.println(WiFi.localIP());

}

void loop() {
  //apakah terkoneksi dengan access point atau tidak?
  //jika terkoneksi maka
  if(WiFi.status()==WL_CONNECTED){
    //eksekusi blok ini jika terkoneksi ke access point
    //deklarasikan objek dari klass HTTPClient
    HTTPClient http;
    //koneksi ke website melalui kontrol.php
    //kalau sudah dihosting
    //http.begin("http://sismoling.com/kontrol-led/kontrol.php");
    //kalau masih localhost, pakai ini:
    http.begin("http://192-------/control_lampu/kontrol.php");
    http.addHeader("Content-Type","application/x-www-form-urlencoded");
    //buat variabel untuk merespon jika sudah terkoneksi
    int httpResponCode = http.POST("token="+ key);
    delay(100);
    //jika berhasil dengan token yang dikirim maka lakukan:
    if(httpResponCode > 0){
      //simpan respond dalam bentuk string
      String response = http.getString();
      //array jsonnya
      char json[500];
      //responcodenya diubah ke tipe data char dalam bentuk array
      response.toCharArray(json, 500);
      //akan melakukan deserialisasi json
      StaticJsonDocument<200>doc;
      deserializeJson(doc,json);
      //tangkap led1 dan simpan di variabel bernama lED1
      int Lampu = doc["lampu"];
     
      Serial.print("lampu:");
      Serial.println(Lampu);
     
      //kontrol LED berdasarkan data yang diperoleh dari database
      if(Lampu == 1){
        //lampu kita atur untuk nyala
        digitalWrite(lampu, HIGH);
        Serial.println("Lampu ON");
      }else{
        //led1 mati
        digitalWrite(lampu, LOW);
        Serial.println("Lampu OFF");
      }
      }else{
      //kalau tidak berhasil
      Serial.print("Error saat mengirimkan POST ke Web");
      Serial.println(httpResponCode);
    }
  }

}