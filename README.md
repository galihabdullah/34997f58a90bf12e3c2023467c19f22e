# 34997f58a90bf12e3c2023467c19f22e
Odeo Programming Test

Project ini dibuat sebagai tugas untuk lamaran di PT. Odeo Teknologi Indonesia.
Teknologi yang digunakan adalah :
1. Nginx
2. PHP 7.3
3. Postgresql 10
4. Composer
5. Beanstalk
6. Docker
7. JWT

Sebelum menjalankan project ini, pastikan sudah install docker-compose.
Untuk menjalankan project ini :
1. Bka terminal / git bash
2. Clone repository ini 
````
git clone https://github.com/galihabdullah/34997f58a90bf12e3c2023467c19f22e.git
````
3. Arahkan terminal / git bash ke directory hasil clone
4. Rename file .env.example menjadi .env dan isikan username dan password email yang akan digunkana untuk mengirim email
5. Jalankan command docker-compose up / sudo docker-compose up
6. Lalu silahkan akses "localhost:8080"
- untuk akses beanstalk-console silahkan akses "localhost:2080"
- untuk akses postgresql diluar container docker : (host : 127.0.0.1, username : postgresondocker, password : postgresondocker, port : 32788)  
