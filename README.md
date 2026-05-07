[09:03, 07/05/2026] +234 905 346 5813: # PHP News Site

A simple PHP and MySQL news website built without frameworks.

## Features

- Display news on homepage
- View full news article
- Admin page
- Create news
- Edit news
- Delete news
- Server-side validation
- Prepared SQL statements
- Basic search

## Requirements

- PHP 8+
- MySQL
- Apache server
- XAMPP, Laragon, WAMP, or similar local server

## Database Setup

Create a database:

```sql
CREATE DATABASE news_site;
 CREATE TABLE news (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    short_description TEXT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);