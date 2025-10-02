# 🌱 Compost Connect

**A community-driven platform for sustainable living and composting**

Compost Connect is a web-based marketplace that brings people together to buy, sell, and exchange compost while promoting eco-friendly practices and reducing food waste. The platform empowers individuals, gardeners, and farmers to create a sustainable network for resource sharing and environmental impact.

---

## 📋 Table of Contents

- [About](#about)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Database Setup](#database-setup)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgments](#acknowledgments)

---

## 🌍 About

Welcome to **Compost Connect**, your go-to platform for sustainable living and community-driven composting.

At Compost Connect, we aim to:
- **Reduce waste** and enrich our soil through composting
- **Connect communities** by creating a network for buying and selling compost
- **Educate users** about transforming food waste into valuable compost
- **Promote eco-friendly practices** for a cleaner planet and greener future

Whether you're a composting enthusiast, a sustainable gardener, or someone looking to make a difference, Compost Connect is here to help you on your journey.

> *"Because every handful of compost makes a difference!"*

---

## ✨ Features

### 🛒 Marketplace
- **Browse Listings**: View available compost from sellers in your area
- **Search & Filter**: Find compost by price, location, and weight
- **Create Listings**: Sell your compost with detailed descriptions
- **Secure Checkout**: Reserve and purchase compost with a simple checkout process

### 👤 User Management
- **User Registration & Login**: Secure authentication with password hashing
- **User Profiles**: Personalized profiles with customizable descriptions
- **My Listings**: Manage your own compost listings
- **Order History**: Track your purchases and sales

### 🗺️ Interactive Map
- **Location Visualization**: View compost locations on an interactive Leaflet.js map
- **Radius Search**: See available compost within a 5-mile radius
- **Geolocation Markers**: Visual indicators for your location and compost listings

### 📚 Educational Content
- **Food Waste Articles**: Learn about the global food waste crisis
- **Composting Guides**: Step-by-step instructions for creating and selling compost
- **Environmental Impact**: Understand how composting helps combat climate change

### 🛡️ Additional Features
- **Report Issues**: Built-in system for reporting problems or concerns
- **Terms of Service**: Clear guidelines for platform usage
- **Admin Controls**: Administrative functions for managing listings
- **Responsive Design**: Mobile-friendly interface that works on all devices

---

## 🛠️ Technologies Used

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Custom styling with responsive design
- **JavaScript (ES6+)** - Interactive functionality
- **Leaflet.js** - Interactive mapping

### Backend
- **PHP** - Server-side logic and processing
- **MySQL** - Database management
- **PDO** - Secure database connections with prepared statements

### Security
- **Password Hashing** - Secure password storage using PHP's `password_hash()`
- **Session Management** - User authentication and authorization
- **SQL Injection Prevention** - Parameterized queries with PDO

---

## 🚀 Getting Started

### Prerequisites

Before you begin, ensure you have the following installed:
- **PHP 7.4+** or higher
- **MySQL 5.7+** or MariaDB
- **Apache** or **Nginx** web server
- **Composer** (optional, for dependency management)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/compost-connect.git
   cd compost-connect
   ```

2. **Configure your web server**
   - Point your web server's document root to the project directory
   - Ensure PHP is properly configured

3. **Update database credentials**
   
   Edit `functions.php` and update the database connection details:
   ```php
   function getConnection() {
       try {
           $conn = new PDO("mysql:host=localhost; dbname=your_database", "your_username", "your_password");
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           return $conn;
       } catch (PDOException $e) {
           echo "Connection failed: " . $e->getMessage();
       }
   }
   ```

### Database Setup

1. **Create the database**
   ```sql
   CREATE DATABASE compost_connect;
   USE compost_connect;
   ```

2. **Create the users table**
   ```sql
   CREATE TABLE users (
       ID INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL UNIQUE,
       passwordHash VARCHAR(255) NOT NULL,
       email VARCHAR(100) NOT NULL,
       description TEXT,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

3. **Create the listings table**
   ```sql
   CREATE TABLE listings (
       ID INT AUTO_INCREMENT PRIMARY KEY,
       userID INT NOT NULL,
       title VARCHAR(100) NOT NULL,
       price DECIMAL(10, 2) NOT NULL,
       weight VARCHAR(50) NOT NULL,
       description TEXT NOT NULL,
       orderedBy INT DEFAULT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (userID) REFERENCES users(ID),
       FOREIGN KEY (orderedBy) REFERENCES users(ID)
   );
   ```

4. **Create the reports table**
   ```sql
   CREATE TABLE reports (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       category VARCHAR(50) NOT NULL,
       description TEXT NOT NULL,
       attachment_path VARCHAR(255) DEFAULT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(ID)
   );
   ```

5. **Start your web server** and navigate to `http://localhost/compost-connect`

---

## 📖 Usage

### For Buyers

1. **Register/Login**: Create an account or log in to your existing account
2. **Browse Listings**: Navigate to the "Listings" page to view available compost
3. **Search**: Use the search bar to find specific listings
4. **View Map**: Click "View Map" to see compost locations
5. **Purchase**: Click "Buy Now" to proceed to checkout
6. **Complete Order**: Fill in your details and confirm your purchase

### For Sellers

1. **Login**: Access your account
2. **Create Listing**: Navigate to your profile and click "Create Listing"
3. **Fill Details**: Provide title, price, weight, and description
4. **Submit**: Your listing will be visible to all buyers
5. **Manage**: View and manage your listings from your profile

### For Administrators

- **Delete Listings**: Admins can remove inappropriate or outdated listings
- **Monitor Reports**: Review user-submitted issue reports
- **User Management**: Oversee user accounts and activities

---

## 📁 Project Structure

```
compost-connect/
├── index.php              # Homepage with educational content
├── login.php              # User login page
├── register.php           # User registration handler
├── logout.php             # Logout functionality
├── profile.php            # User profile and listings management
├── listings.php           # Browse all compost listings
├── createlisting.php      # Create new compost listing
├── deletelisting.php      # Delete listing (admin)
├── checkout.php           # Checkout and order processing
├── map.php                # Interactive map view
├── reportIssue.php        # Report issues form
├── reportProcess.php      # Process issue reports
├── TOS.php                # Terms of Service
├── functions.php          # Core PHP functions and database connection
├── script.js              # Main JavaScript functionality
├── listings.js            # Listings-specific JavaScript
├── map.js                 # Map functionality with Leaflet.js
├── TOS.js                 # Terms of Service JavaScript
├── styles.css             # Main stylesheet
├── references.txt         # Image attribution
└── *.jpg                  # Image assets
```

---

## 🖼️ Screenshots

*Add screenshots of your application here to showcase the user interface*

---

## 📄 License

This project is part of a Team Project and Professionalism course. Please check with the project maintainers for licensing information.

---

## 🙏 Acknowledgments

- **Photo Credits**:
  - Photo by Igor Kocka: [Pexels](https://www.pexels.com/photo/a-trash-can-filled-with-leaves-and-branches-17577525/)
  - Photo by Kindel Media: [Pexels](https://www.pexels.com/photo/man-in-black-tank-top-and-blue-denim-jeans-holding-brown-and-white-round-food-in-on-on-on-on-8826306/)
- **Leaflet.js** - For the interactive mapping functionality
- **OpenStreetMap** - For map tiles and data

---
