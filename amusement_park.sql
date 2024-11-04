CREATE DATABASE amusement_park;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,     
    name VARCHAR(255) NOT NULL,            
    email VARCHAR(255) NOT NULL UNIQUE,    
    password VARCHAR(255) NOT NULL,        
    accessibility_preferences TEXT         
);
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    ride_service VARCHAR(100) NOT NULL,
    booking_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE bookings ADD COLUMN user_id INT;

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique identifier for each feedback
    name VARCHAR(100) NOT NULL,           -- Name of the person giving feedback
    email VARCHAR(100) NOT NULL,          -- Email address of the person
    visit_date DATE NOT NULL,             -- Date of visit
    comments TEXT NOT NULL,                -- Comments from the person
    rating INT CHECK (rating >= 1 AND rating <= 5)  -- Rating between 1 and 5
);

CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    message VARCHAR(255),
    status VARCHAR(50),
    created_at DATETIME
);
CREATE TABLE rides_services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
INSERT INTO rides_services (name) VALUES ('Rollercoaster'), ('Water Park'), ('Ferris Wheel'), ('Bumper Cars');
CREATE TABLE virtual_queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ride_id INT NOT NULL,
    user_id INT NOT NULL,
    queue_position INT NOT NULL,
    status ENUM('waiting', 'near', 'active') DEFAULT 'waiting',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ride_id) REFERENCES rides_services(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
ALTER TABLE virtual_queue ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;
