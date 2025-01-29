# News Application

## Overview

This Laravel-based news application integrates with **The Guardian API** and **News API** to fetch and store news articles. Users can browse articles, filter them, and authenticate to personalize their news feed and mark their favourite authors and categories.

---

## Features

✅ Sync news articles hourly from The Guardian and News API  
✅ Public API access for latest articles with filtering options  
✅ User authentication (registration, login, profile, and logout)  
✅ Authenticated users can mark authors and categories as favorites  
✅ Personalized news feed for authenticated users (related-articles)  
✅ Fully containerized using **Docker & Docker Compose**

---

## 🚀 Installation & Setup

### **1. Clone the Repository**
```bash
git clone https://github.com/mhdwaseem-kh/News-APP.git
cd news-app
```


### **2. Create an ```.env``` File**
```bash
cp .env.example .env
```

### **3. Run Composer**
```bash
composer install
```

### **4. Update the following environment variables in ```.env```:**
```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=news-app
DB_USERNAME=root
DB_PASSWORD=root
```

### **5. Start the Application (Docker)**
```bash
docker compose up -d --build
```

### **6. Run Migrations**
```bash
docker exec -it news_app php artisan migrate
```
or

```bash
php artisan migrate
```

### **7. Run Seeder (Important)**
```bash
docker exec -it news_app php artisan db:seed
```
or

```bash
php artisan db:seed
```

### **8. Run Schedule**
```bash
docker exec -it news_app php artisan schedule:work
```
or

```bash
php artisan schedule:work
```

### **9. You can Run the following to fetch articles for the first time**
```bash
docker exec -it news_app php artisan articles:sync
```
or

```bash
php artisan articles:sync
```
