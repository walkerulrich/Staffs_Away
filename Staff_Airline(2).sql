Create database Staff_Airline;
use Staff_Airline;

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_id` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

CREATE TABLE Cities (
    city_id INT AUTO_INCREMENT PRIMARY KEY,
    city_name VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL
);

CREATE TABLE Airports (
    airport_id INT AUTO_INCREMENT PRIMARY KEY,
    airport_name VARCHAR(255) NOT NULL,
    city_id INT,
    FOREIGN KEY (city_id) REFERENCES Cities(city_id) ON DELETE CASCADE
);

INSERT INTO Cities (city_name, country) VALUES
('Ngaoundere', 'Cameroon'),
('Douala', 'Cameroon'),
('Abidjan', 'Ivory Coast'),
('Yamoussoukro', 'Ivory Coast'),
('San-Pédro', 'Ivory Coast'),
('New York', 'United States'),
('London', 'United Kingdom'),
('Paris', 'France'),
('Tokyo', 'Japan'),
('Cairo', 'Egypt'),
('Lagos', 'Nigeria'),
('Johannesburg', 'South Africa'),
('Nairobi', 'Kenya'),
('Casablanca', 'Morocco'),
('Algiers', 'Algeria'),
('Accra', 'Ghana'),
('Abuja', 'Nigeria'),
('Addis Ababa', 'Ethiopia'),
('Dar es Salaam', 'Tanzania'),
('Los Angeles', 'United States'),
('Chicago', 'United States'),
('Toronto', 'Canada'),
('Sydney', 'Australia'),
('Melbourne', 'Australia'),
('Berlin', 'Germany'),
('Madrid', 'Spain'),
('Rome', 'Italy'),
('Moscow', 'Russia'),
('Beijing', 'China'),
('Shanghai', 'China'),
('Seoul', 'South Korea'),
('Mumbai', 'India'),
('Cairo', 'Egypt'),
('Mexico City', 'Mexico'),
('Rio de Janeiro', 'Brazil'),
('São Paulo', 'Brazil'),
('Buenos Aires', 'Argentina'),
('Dubai', 'United Arab Emirates'),
('Istanbul', 'Turkey');


INSERT INTO Airports (airport_name, city_id) VALUES
-- Cameroon
('Ngaoundere Airport', 1), -- Ngaoundere, Cameroon
('Maroua-Salak Airport', 1), -- Ngaoundere, Cameroon
('Douala International Airport', 2), -- Douala, Cameroon

-- Ivory Coast
('Port Bouet Airport', 3), -- Abidjan, Ivory Coast
('Felix-Houphouët-Boigny International Airport', 3), -- Abidjan, Ivory Coast
('Yamoussoukro Airport', 4), -- Yamoussoukro, Ivory Coast
('San-Pédro Airport', 5), -- San-Pédro, Ivory Coast

-- United States
('John F. Kennedy International Airport', 6), -- New York, United States
('LaGuardia Airport', 6), -- New York, United States
('Julius Nyerere International Airport', 19), -- Dar es Salaam, Tanzania
('Los Angeles International Airport', 20),

-- United Kingdom
('Heathrow Airport', 7), -- London, United Kingdom
('Gatwick Airport', 7), -- London, United Kingdom

-- France
('Charles de Gaulle Airport', 8), -- Paris, France
('Orly Airport', 8), -- Paris, France

-- Japan
('Narita International Airport', 9), -- Tokyo, Japan
('Haneda Airport', 9), -- Tokyo, Japan

-- Egypt
('Cairo International Airport', 10), -- Cairo, Egypt
('Borg El Arab Airport', 10), -- Cairo, Egypt

-- Nigeria
('Murtala Muhammed International Airport', 11), -- Lagos, Nigeria
('Ikeja Airport', 11), -- Lagos, Nigeria
('Nnamdi Azikiwe International Airport', 17), -- Abuja, Nigeria
('Kaduna Airport', 17), -- Abuja, Nigeria

('O. R. Tambo International Airport', 12), -- Johannesburg, South Africa
('Jomo Kenyatta International Airport', 13), -- Nairobi, Kenya
('Mohammed V International Airport', 14), -- Casablanca, Morocco
('Houari Boumediene Airport', 15), -- Algiers, Algeria
('Kotoka International Airport', 16), -- Accra, Ghana
('Addis Ababa Bole International Airport', 18), -- Addis Ababa, Ethiopia
('Chicago Midway International Airport', 21), -- Chicago, United States
('Billy Bishop Toronto City Airport', 22), -- Toronto, Canada
('Sydney Airport', 23), -- Sydney, Australia
('Melbourne Airport', 24), -- Melbourne, Australia
('Berlin Brandenburg Airport', 25), -- Berlin, Germany
('Adolfo Suárez Madrid–Barajas Airport', 26), -- Madrid, Spain
('Leonardo da Vinci-Fiumicino Airport', 27), -- Rome, Italy
('Sheremetyevo International Airport', 28), -- Moscow, Russia
('Beijing Capital International Airport', 29), -- Beijing, China
('Shanghai Pudong International Airport', 30), -- Shanghai, China
('Incheon International Airport', 31), -- Seoul, South Korea
('Chhatrapati Shivaji Maharaj International Airport', 32), -- Mumbai, India
('Cairo International Airport', 33),
('Mexico City International Airport', 34), -- Mexico City, Mexico
('Rio de Janeiro/Galeão–Antonio Carlos Jobim International Airport', 35), -- Rio de Janeiro, Brazil
('São Paulo/Guarulhos–Governador André Franco Montoro International Airport', 36), -- São Paulo, Brazil
('Ministro Pistarini International Airport', 37), -- Buenos Aires, Argentina
('Dubai International Airport', 38), -- Dubai, United Arab Emirates
('Istanbul Airport', 39); -- Istanbul, Turkey






CREATE TABLE Commercial_plane (
    plane_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    manufacturer VARCHAR(255) NOT NULL,
    year_of_manufacture int(11) DEFAULT NULL,
    model VARCHAR(255) NOT NULL,
    registration_number VARCHAR(50) DEFAULT NULL,  
    maximum_capacity INT(11) NOT NULL,
    availability_status ENUM('available', 'booked', 'maintenance') DEFAULT 'available',
    maintenance_history TEXT DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP   
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO Commercial_plane (manufacturer, year_of_manufacture, model, registration_number, maximum_capacity, availability_status, maintenance_history) 
-- Inserting a Boeing 737
 VALUES ('Boeing', 2015, '737', 'N12345', 189, 'available', 'Regular maintenance checks'),
-- Inserting an Airbus A320
 ('Airbus', 2018, 'A320', 'N54321', 186, 'booked', 'Recent engine overhaul'),
-- Inserting a Bombardier CRJ900
 ('Bombardier', 2016, 'CRJ900', 'N98765', 90, 'maintenance', 'Scheduled maintenance in progress'),
-- Inserting a Embraer E190
 ('Embraer', 2017, 'E190', 'N24680', 114, 'available', 'No maintenance issues reported'),
-- Inserting a Boeing 777
 ('Boeing', 2019, '777', 'N77777', 396, 'available', 'Routine maintenance completed'),
-- Inserting an Airbus A350
 ('Airbus', 2020, 'A350', 'N350XX', 325, 'booked', 'Avionics system upgrade in progress'),
-- Inserting a Bombardier Global 7500
 ('Bombardier', 2021, 'Global 7500', 'N7500GL', 19, 'available', 'No maintenance required'),
-- Inserting a Embraer E195
 ('Embraer', 2018, 'E195', 'N195EM', 124, 'maintenance', 'Engine inspection scheduled'),
-- Inserting a McDonnell Douglas MD-80
 ('McDonnell Douglas', 1990, 'MD-80', 'N800MD', 172, 'available', 'Frequent maintenance due to age'),
-- Inserting a Boeing 787
 ('Boeing', 2016, '787', 'N787XX', 330, 'booked', 'Scheduled maintenance next month'),
-- Inserting an Airbus A380
 ('Airbus', 2014, 'A380', 'N380AB', 853, 'available', 'Routine checks completed'),
-- Inserting a Bombardier CRJ700
 ('Bombardier', 2017, 'CRJ700', 'N700CR', 78, 'maintenance', 'Avionics upgrade scheduled'),
-- Inserting a Embraer E175
 ('Embraer', 2019, 'E175', 'N175EM', 80, 'available', 'No issues reported'),
-- Inserting a Airbus A330
 ('Airbus', 2015, 'A330', 'N330XX', 335, 'booked', 'Scheduled engine overhaul'),
-- Inserting a Boeing 737 MAX
 ('Boeing', 2022, '737 MAX', 'N737MX', 230, 'available', 'Initial checks completed'),
-- Inserting a Bombardier Dash 8 Q400
 ('Bombardier', 2016, 'Dash 8 Q400', 'N400BD', 90, 'maintenance', 'Propeller inspection due'),
-- Inserting a Embraer E170
 ('Embraer', 2017, 'E170', 'N170EM', 76, 'available', 'Regular maintenance checks'),
-- Inserting a Airbus A319
 ('Airbus', 2018, 'A319', 'N319XX', 160, 'booked', 'Avionics upgrade scheduled'),
-- Inserting a Boeing 747
 ('Boeing', 2017, '747', 'N747XX', 467, 'available', 'Routine maintenance completed'),
-- Inserting a Bombardier CRJ1000
 ('Bombardier', 2019, 'CRJ1000', 'N100CR', 104, 'maintenance', 'Hydraulic system check due'),
-- Inserting a Embraer E145
 ('Embraer', 2016, 'E145', 'N145EM', 50, 'available', 'No issues reported'),
-- Inserting a Boeing 767
 ('Boeing', 2015, '767', 'N767XX', 375, 'booked', 'Scheduled engine overhaul'),
-- Inserting an Airbus A321
 ('Airbus', 2020, 'A321', 'N321XX', 220, 'available', 'Routine checks completed'),
-- Inserting a Bombardier CRJ200
 ('Bombardier', 2018, 'CRJ200', 'N200CR', 50, 'maintenance', 'Electrical system inspection due');




CREATE TABLE `Flights` (
  `flight_id` int(11) NOT NULL,
  `plane_id` int(11) NOT NULL,
  `airline` varchar(255) NOT NULL,
  `flight_number` varchar(255) NOT NULL,
  `departure_airport`  int NOT NULL,
  `arrival_airport`  int NOT NULL,
  `departure_datetime` datetime NOT NULL,
  `arrival_datetime` datetime NOT NULL,
  `flight_duration` time DEFAULT NULL,
   flight_status ENUM('scheduled', 'ongoing', 'delayed', 'cancelled', 'completed') DEFAULT 'scheduled',
  `ticket_price` decimal(10,2) DEFAULT NULL,
  `available_seats` int(11) DEFAULT NULL,
  `stopover_info` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
   FOREIGN KEY (`plane_id`) REFERENCES `Commercial_plane`(`plane_id`) ON DELETE CASCADE,
   FOREIGN KEY (`departure_airport`) REFERENCES `Airports`(`airport_id`) ON DELETE CASCADE,
  FOREIGN KEY (`arrival_airport`) REFERENCES `Airports`(`airport_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `Flights`
  ADD PRIMARY KEY (`flight_id`);

ALTER TABLE `Flights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO Flights (plane_id, airline, flight_number, departure_airport, arrival_airport, departure_datetime, arrival_datetime, flight_duration, flight_status, ticket_price, available_seats, stopover_info) 
VALUES 

(6, 'American Airlines', 'AA333', 1, 6, '2024-05-06 09:00:00', '2024-05-06 13:00:00', '04:00:00', 'scheduled', 280.00, 325, NULL),
(7, 'Qatar Airways', 'QR777', 2, 9, '2024-05-07 11:00:00', '2024-05-07 19:00:00', '08:00:00', 'scheduled', 550.00, 19, 'One stopover at Doha Hamad International Airport'),
(8, 'United Airlines', 'UA888', 20, 3, '2024-05-08 13:00:00', '2024-05-08 17:00:00', '04:00:00', 'scheduled', 320.00, 124, NULL),
(9, 'Singapore Airlines', 'SQ999', 31, 4, '2024-05-09 15:00:00', '2024-05-09 21:00:00', '06:00:00', 'scheduled', 600.00, 172, NULL),
(10, 'Cathay Pacific', 'CX111', 30, 5, '2024-05-10 17:00:00', '2024-05-10 23:00:00', '06:00:00', 'scheduled', 580.00, 330, NULL),
(11, 'Etihad Airways', 'EY222', 38, 7, '2024-05-11 19:00:00', '2024-05-11 01:00:00', '06:00:00', 'scheduled', 520.00, 853, 'One stopover at Abu Dhabi International Airport'),
(12, 'Turkish Airlines', 'TK333', 39, 8, '2024-05-12 21:00:00', '2024-05-13 03:00:00', '06:00:00', 'scheduled', 450.00, 78, NULL),
(13, 'Lufthansa', 'LH444', 7, 9, '2024-05-14 08:00:00', '2024-05-14 14:00:00', '06:00:00', 'scheduled', 380.00, 80, NULL),
(14, 'Air Canada', 'AC555', 22, 10, '2024-05-15 10:00:00', '2024-05-15 14:00:00', '04:00:00', 'scheduled', 340.00, 335, NULL),
(15, 'KLM Royal Dutch Airlines', 'KL666', 8, 11, '2024-05-16 12:00:00', '2024-05-16 18:00:00', '06:00:00', 'scheduled', 360.00, 230, NULL),
(16, 'Qantas', 'QF777', 23, 12, '2024-05-17 14:00:00', '2024-05-17 20:00:00', '06:00:00', 'scheduled', 570.00, 90, NULL),
(17, 'EgyptAir', 'MS888', 10, 13, '2024-05-18 16:00:00', '2024-05-18 20:00:00', '04:00:00', 'scheduled', 320.00, 76, NULL),

(18, 'South African Airways', 'SA999', 12, 14, '2024-05-19 18:00:00', '2024-05-19 22:00:00', '04:00:00', 'scheduled', 340.00, 160, NULL),
(18, 'South African Airways', 'SA999', 14, 12, '2024-06-19 18:00:00', '2024-06-19 22:00:00', '04:00:00', 'scheduled', 340.00, 160, NULL),
/*au dessuus vol aller retour */

(19, 'Kenya Airways', 'KQ111', 13, 15, '2024-05-20 20:00:00', '2024-05-21 02:00:00', '06:00:00', 'scheduled', 480.00, 467, 'One stopover at Jomo Kenyatta International Airport'),
(20, 'Virgin Atlantic', 'VS222', 6, 16, '2024-05-22 22:00:00', '2024-05-23 04:00:00', '06:00:00', 'scheduled', 400.00, 104, NULL),
(21, 'Finnair', 'AY333', 7, 6, '2024-05-24 09:00:00', '2024-05-24 15:00:00', '06:00:00', 'scheduled', 370.00, 50, NULL),
(22, 'Air New Zealand', 'NZ444', 23, 17, '2025-01-07 17:00:00', '2025-02-25 09:30:00', '06:00:00', 'scheduled', 550.00, 375, NULL),
(23, 'Alitalia', 'AZ555', 27, 18, '2025-02-07 09:30:00', '2025-02-07 19:30:00', '06:00:00', 'scheduled', 390.00, 220, NULL),
(24, 'LATAM Airlines', 'LA666', 35, 19, '2025-03-07 12:30:00', '2025-03-07 20:30:00', '06:00:00', 'scheduled', 580.00, 50, NULL),
(1, 'Iberia', 'IB777', 26, 6, '2025-04-07 15:30:00', '2025-04-07 17:30:00', '02:00:00', 'scheduled', 420.00, 189, NULL),
(2, 'SAS Scandinavian Airlines', 'SK888', 7, 20, '2025-07-07 16:30:00', '2025-07-07 23:00:00', '06:30:00', 'scheduled', 440.00, 186, NULL),
(3, 'Etihad Airways', 'EY222', 38, 21, '2025-08-07 11:30:00', '2025-08-07 15:17:00', '03:47:00', 'scheduled', 520.00, 90, 'One stopover at Abu Dhabi International Airport'),
(4, 'Turkish Airlines', 'TK333', 39, 22, '2025-09-07 14:30:00', '2025-09-08 16:30:00', '26:00:00', 'scheduled', 450.00, 114, NULL),
(5, 'Lufthansa', 'LH444', 7, 23, '2025-10-07 17:30:00', '2025-10-07 19:30:00', '02:00:00', 'scheduled', 380.00, 396, NULL),
(6, 'Air Canada', 'AC555', 22, 24, '2025-11-07 09:45:00', '2025-11-07 19:45:00', '10:00:00', 'scheduled', 340.00, 325, NULL),
(7, 'KLM Royal Dutch Airlines', 'KL666', 8, 25, '2026-01-01 12:45:00', '2026-01-01 20:45:00', '08:00:00', 'scheduled', 360.00, 19, NULL),
(8, 'Qantas', 'QF777', 23, 26, '2026-01-02 14:00:00', '2026-01-02 20:00:00', '06:00:00', 'scheduled', 570.00, 124, NULL),
(9, 'EgyptAir', 'MS888', 10, 27, '2026-01-03 16:00:00', '2026-01-03 20:00:00', '04:00:00', 'scheduled', 320.00, 172, NULL),
(10, 'South African Airways', 'SA999', 12, 28, '2026-01-04 18:00:00', '2026-01-04 22:00:00', '04:00:00', 'scheduled', 340.00, 330, NULL),
(11, 'Kenya Airways', 'KQ111', 13, 29, '2026-01-05 20:00:00', '2026-01-06 02:00:00', '06:00:00', 'scheduled', 480.00, 853, 'One stopover at Jomo Kenyatta International Airport'),
(12, 'Virgin Atlantic', 'VS222', 6, 30, '2026-01-06 22:00:00', '2026-01-07 04:00:00', '06:00:00', 'scheduled', 400.00, 78, NULL),
(13, 'Finnair', 'AY333', 7, 31, '2026-01-07 09:00:00', '2026-01-07 15:00:00', '06:00:00', 'scheduled', 370.00, 80, NULL),
(1, 'Delta Air Lines', 'DL333', 26, 15, '2024-05-06 09:30:00', '2024-05-06 13:30:00', '04:00:00', 'ongoing', 290.00, 0, NULL),
(2, 'Emirates', 'EK777', 27, 18, '2024-05-07 11:30:00', '2024-05-07 19:30:00', '08:00:00', 'ongoing', 560.00, 18, 'One stopover at Dubai International Airport'),
(3, 'British Airways', 'BA888', 30, 21, '2024-05-08 13:30:00', '2024-05-08 17:30:00', '04:00:00', 'ongoing', 330.00, 16, NULL),
(4, 'ANA All Nippon Airways', 'NH999', 37, 24, '2024-05-09 15:30:00', '2024-05-09 21:30:00', '06:00:00', 'ongoing', 610.00, 10, NULL),
(5, 'Swiss International Air Lines', 'LX111', 48, 25, '2024-05-10 17:30:00', '2024-05-10 23:30:00', '06:00:00', 'ongoing', 590.00, 11, NULL),
(6, 'Vietnam Airlines', 'VN222', 16, 12, '2024-05-11 19:30:00', '2024-05-11 01:30:00', '06:00:00', 'ongoing', 530.00, 10, 'One stopover at Noi Bai International Airport'),
(7, 'EVA Air', 'BR333', 1, 30, '2024-05-12 21:30:00', '2024-05-13 03:30:00', '06:00:00', 'ongoing', 460.00, 2, NULL),
(8, 'Japan Airlines', 'JL444', 2, 32, '2024-05-14 08:30:00', '2024-05-14 14:30:00', '06:00:00', 'ongoing', 390.00, 20, NULL),
(9, 'Emirates', 'EK555', 3, 17, '2024-05-15 10:30:00', '2024-05-15 14:30:00', '04:00:00', 'ongoing', 350.00, 12, NULL),
(10, 'Qatar Airways', 'QR666', 4, 13, '2024-05-16 12:30:00', '2024-05-16 18:30:00', '06:00:00', 'ongoing', 370.00, 20, 'One stopover at Doha Hamad International Airport'),
(11, 'Lufthansa', 'LH777', 13, 8, '2024-05-17 14:30:00', '2024-05-17 20:30:00', '06:00:00', 'ongoing', 590.00, 3, NULL),
(12, 'American Airlines', 'AA444', 11, 32, '2024-05-06 09:30:00', '2024-05-06 13:30:00', '04:00:00', 'delayed', 280.00, 16, NULL),
(13, 'Qatar Airways', 'QR888', 38, 9, '2024-05-07 11:30:00', '2024-05-07 19:30:00', '08:00:00', 'delayed', 550.00, 27, 'One stopover at Doha Hamad International Airport'),
(14, 'United Airlines', 'UA999', 20, 33, '2024-05-08 13:30:00', '2024-05-08 17:30:00', '04:00:00', 'delayed', 320.00, 10, NULL),
(15, 'Singapore Airlines', 'SQ111', 31, 34, '2024-05-09 15:30:00', '2024-05-09 21:30:00', '06:00:00', 'delayed', 600.00, 2, NULL),
(16, 'Cathay Pacific', 'CX222', 30, 35, '2024-05-10 17:30:00', '2024-05-10 23:30:00', '06:00:00', 'delayed', 580.00, 4, NULL),
(17, 'American Airlines', 'AA444', 11, 36, '2024-05-06 10:00:00', '2024-05-06 14:00:00', '04:00:00', 'canceled', 280.00, 0, NULL),
(18, 'Qatar Airways', 'QR888', 38, 37, '2024-05-07 12:00:00', '2024-05-07 20:00:00', '08:00:00', 'canceled', 550.00, 0, 'One stopover at Doha Hamad International Airport'),
(19, 'United Airlines', 'UA999', 20, 38, '2024-05-08 14:00:00', '2024-05-08 18:00:00', '04:00:00', 'canceled', 320.00, 10, NULL),
(20, 'Singapore Airlines', 'SQ111', 31, 39, '2024-05-09 16:00:00', '2024-05-09 22:00:00', '06:00:00', 'canceled', 600.00, 20, NULL),
(21, 'Cathay Pacific', 'CX222', 30, 40, '2024-05-10 18:00:00', '2024-05-10 00:00:00', '06:00:00', 'canceled', 580.00, 5, NULL),
(1, 'Delta Air Lines', 'DL123', 6, 41, '2023-05-01 08:00:00', '2023-05-01 12:00:00', '04:00:00', 'completed', 300.00, 0, NULL),
(2, 'British Airways', 'BA456', 15, 42, '2023-05-02 10:00:00', '2023-05-02 14:00:00', '04:00:00', 'completed', 350.00, 0, NULL),
(3, 'Emirates', 'EK789', 6, 43, '2023-05-03 12:00:00', '2023-05-03 20:00:00', '08:00:00', 'completed', 600.00, 0, 'One stopover at Dubai International Airport'),
(4, 'ANA All Nippon Airways', 'NH012', 44, 45, '2023-05-04 14:00:00', '2023-05-04 20:00:00', '06:00:00', 'completed', 480.00, 7, NULL),
(5, 'Lufthansa', 'LH345', 46, 47, '2023-05-05 16:00:00', '2023-05-05 20:00:00', '04:00:00', 'completed', 320.00, 8, NULL),
(6, 'Air France', 'AF678', 1, 33, '2023-05-06 18:00:00', '2023-05-06 22:00:00', '04:00:00', 'completed', 340.00, 10, NULL),
(7, 'Korean Air', 'KE901', 33, 34, '2023-05-07 20:00:00', '2023-05-08 02:00:00', '06:00:00', 'completed', 490.00, 0, NULL),
(8, 'Japan Airlines', 'JL234', 28, 35, '2023-05-08 22:00:00', '2023-05-09 04:00:00', '06:00:00', 'completed', 520.00, 1, NULL),
(9, 'Delta Air Lines', 'DL567', 17, 36, '2023-05-09 08:00:00', '2023-05-09 12:00:00', '04:00:00', 'completed', 310.00, 10, NULL),
(10, 'Turkish Airlines', 'TK890', 27, 37, '2023-05-10 10:00:00', '2023-05-10 14:00:00', '04:00:00', 'completed', 330.00, 2, NULL);


CREATE TABLE `booking_flight` (
  `booking_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `departure_flight_id` int(11) DEFAULT NULL,
  `return_flight_id` int(11) DEFAULT NULL,
  `booking_date` date NOT NULL DEFAULT curdate(),
  `number_of_passengers` int(11) NOT NULL,
  `status` enum('Confirmed','Cancelled') NOT NULL DEFAULT 'Confirmed',
  `price` decimal(10,2) DEFAULT NULL,
  `departure_seat` varchar(255) DEFAULT NULL,
  `return_seat` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `skypriority` tinyint(1) DEFAULT 0,
  `lounge_access` tinyint(1) DEFAULT 0,
  `checked_baggage` int(11) DEFAULT 0,
  `cabin_baggage` int(11) DEFAULT 1,
  `refundable` tinyint(1) DEFAULT 0,
  `front_seats` tinyint(1) DEFAULT 0,
  `insurance` int(11) DEFAULT 0,
  `class` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `booking_flight`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `departure_flight_id` (`departure_flight_id`),
  ADD KEY `return_flight_id` (`return_flight_id`);


ALTER TABLE `booking_flight`
  ADD CONSTRAINT `booking_flight_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_flight_ibfk_2` FOREIGN KEY (`departure_flight_id`) REFERENCES `Flights` (`flight_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_flight_ibfk_3` FOREIGN KEY (`return_flight_id`) REFERENCES `Flights` (`flight_id`) ON DELETE CASCADE;


-- Table des Emplacements
CREATE TABLE Locations (
  location_id INT PRIMARY KEY AUTO_INCREMENT,
  location_name VARCHAR(255) NOT NULL,
  latitude DECIMAL(10, 8),  -- Latitude
  longitude DECIMAL(11, 8),  -- Longitude
  country VARCHAR(100),  -- Pays
  city VARCHAR(100),  -- Ville
  airport_code VARCHAR(10),  -- Code de l'aéroport (ex : LHR)
  description TEXT  -- Description de l'emplacement
);



CREATE TABLE `Rental_planes` (
  `rental_id` int(11) NOT NULL AUTO_INCREMENT,  
  `manufacturer` varchar(255) NOT NULL,        
  `model` varchar(255) NOT NULL,               
  `year_of_manufacture` int(11) DEFAULT NULL,  
  `registration_number` varchar(50) UNIQUE,    
  `maximum_capacity` int(11) NOT NULL,         
  `maximum_range` int(11) DEFAULT NULL,        
  `rental_price_per_hour` decimal(10,2) NOT NULL, 
  `availability_status` enum('available', 'booked', 'maintenance') DEFAULT 'available', 
  `maintenance_history` text DEFAULT NULL,     
  `features` text DEFAULT NULL,                
  `description` text DEFAULT NULL,             
  `detailed_description` text DEFAULT NULL,    
  `rating` float DEFAULT NULL,                 
  `number_of_reviews` int(11) DEFAULT 0,       
  `image_path` varchar(255) DEFAULT NULL,      
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, 
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  base_location INT,
  FOREIGN KEY (base_location) REFERENCES Locations(location_id) ON DELETE CASCADE,
  PRIMARY KEY (`rental_id`)                    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;         


 -- Insert planes into the Rental_planes table
INSERT INTO `Rental_planes` 
(`manufacturer`, `model`, `year_of_manufacture`, `registration_number`, `maximum_capacity`, 
`maximum_range`, `rental_price_per_hour`, `availability_status`, `maintenance_history`, 
`features`, `detailed_description`, `description`, `rating`, `number_of_reviews`, `image_path`) 
VALUES 
-- Plane 1: Gulfstream G650
('Gulfstream', 'G650', 2017, 'N650GX', 18, 7000, 7000.00, 'available', 'Routine check completed.', 
'High-speed connectivity, spacious cabin, advanced safety features.', 
'A high-speed, long-range business jet with luxurious amenities and advanced safety features.', 
'Luxurious business jet with advanced features.', 4.9, 120, '../Img/Gulfstream.jpg'),

-- Plane 2: Cessna Citation X
('Cessna', 'Citation X', 2015, 'N750CX', 12, 3000, 5000.00, 'available', 'Engines serviced in 2020.', 
'High speed, comfortable cabin, Wi-Fi enabled.', 
'A fast business jet with a sleek design and comfortable cabin.', 
'A fast business jet with a sleek design.', 4.7, 95, '../Img/cessna-citation-x.jpg'),

-- Plane 3: Embraer Phenom 300
('Embraer', 'Phenom 300', 2018, 'N300EX', 10, 3600, 5500.00, 'available', 'Airframe inspection in 2021.', 
'Spacious interior, efficient fuel usage, modern avionics.', 
'An efficient business jet with modern features and a comfortable cabin.', 
'An efficient business jet with modern features.', 4.8, 105, '../Img/embraer-phenom-300-exterior-2.png'),

-- Plane 4: Dassault Falcon 900EX
('Dassault', 'Falcon 900EX', 2016, 'N900EX', 14, 4500, 6000.00, 'available', 'Hydraulics serviced in 2019.', 
'Versatile jet, luxurious interiors, modern amenities.', 
'A mid-size jet with luxurious interiors and versatile performance.', 
'A mid-size jet with luxurious amenities.', 4.6, 85, '../Img/FA900EXeasy-exterior-1200x600.jpg'),

-- Plane 5: Pilatus PC-24
('Pilatus', 'PC-24', 2019, 'N24PC', 10, 3000, 4500.00, 'available', 'Recent avionics upgrade.', 
'Super versatile, comfortable cabin, short takeoff and landing.', 
'A versatile business jet for short to medium-range flights.', 
'A versatile business jet for short to medium-range flights.', 4.5, 90, '../Img/pc-24-super-versatile-jet-scaled-1.jpg'),

-- Plane 6: HondaJet Elite S
('Honda Aircraft', 'HondaJet Elite S', 2020, 'Njet-Elite-S-flight', 6, 1200, 2500.00, 'available', 'Maintenance completed in 2022.', 
'Compact design, efficient, advanced technology.', 
'A compact and efficient business jet for short-range flights.', 
'A compact and efficient business jet for short-range flights.', 4.4, 65, '../Img/HondaJet-Elite-S-flight.avif'),

-- Plane 7: Beechcraft Baron G58
('Beechcraft', 'Baron G58', 2017, 'N58BG', 6, 1000, 1500.00, 'available', 'Airframe inspection in 2021.', 
'Twin-engine, ideal for short trips.', 
'A light twin-engine aircraft suitable for short trips.', 
'A light twin-engine aircraft suitable for short trips.', 4.3, 60, '../Img/baron-G58-charter.jpg'),

-- Plane 8: Cirrus SF50 Vision G2
('Cirrus Aircraft', 'Cirrus SF50 Vision G2', 2018, 'NSF50', 7, 1200, 3500.00, 'available', 'New avionics system installed in 2020.', 
'Personal jet, innovative safety features.', 
'A modern personal jet with innovative safety features.', 
'A modern personal jet with innovative safety features.', 4.6, 70, '../Img/Cirrus-SF50_Vision_G2_flyer-1.jpg'),

-- Plane 9: Dassault Falcon 7X
('Dassault Aviation', 'Falcon 7X', 2014, 'N7X', 12, 6500, 6800.00, 'available', 'Hydraulics and landing gear serviced in 2020.', 
'Long-range business jet, luxurious interiors.', 
'A long-range business jet with luxurious interiors.', 
'A long-range business jet with high capacity.', 4.7, 110, '../Img/2620031.jpg'),

-- Plane 10: Learjet 75
('Learjet', 'Learjet 75', 2016, 'NL75', 9, 2300, 3800.00, 'available', 'Routine maintenance in 2019.', 
'Small business jet, advanced technology.', 
'A small business jet with advanced technology.', 
'A small business jet with advanced technology.', 4.4, 75, '../Img/2621927.jpg');


-- Insert planes into the Rental_planes table
INSERT INTO `Rental_planes` 
(`manufacturer`, `model`, `year_of_manufacture`, `registration_number`, `maximum_capacity`, 
`maximum_range`, `rental_price_per_hour`, `availability_status`, `maintenance_history`, 
`features`, `detailed_description`, `description`, `rating`, `number_of_reviews`, `image_path`) 
VALUES 
-- Plane 11: Gulfstream G280
('Gulfstream', 'G280', 2018, 'NG280', 10, 3600, 6000.00, 'available', 'Annual inspection completed.', 
'Luxurious interiors, advanced avionics, high-speed connectivity.', 
'A versatile business jet with advanced avionics and high-speed connectivity.', 
'A luxurious business jet with advanced avionics.', 4.7, 100, '../Img/374015-dahj_WAS8037a-f8ea1e-large-1608632692.jpg'),

-- Plane 12: Embraer Legacy 450
('Embraer', 'Legacy 450', 2017, 'NL450', 9, 2800, 4500.00, 'available', 'Avionics system updated in 2020.', 
'Spacious cabin, advanced technology, high speed.', 
'A high-speed business jet with a spacious cabin and advanced technology.', 
'A high-speed business jet with a spacious cabin.', 4.6, 85, '../Img/p500-netjets-final-01-M4pN3v__wide__970.jpg'),

-- Plane 13: Bombardier Challenger 350
('Bombardier', 'Challenger 350', 2016, 'NC350', 12, 3600, 5800.00, 'available', 'Engines serviced in 2019.', 
'Spacious cabin, high-performance engines, advanced avionics.', 
'A high-performance business jet with a spacious cabin.', 
'A high-performance business jet with spacious interiors.', 4.8, 110, '../Img/Cirrus-SF50_Vision_G2_flyer-1.jpg'),

-- Plane 14: Beechcraft King Air 350i
('Beechcraft', 'King Air 350i', 2017, 'NK350i', 9, 1800, 2800.00, 'available', 'Airframe inspection completed.', 
'Twin-engine turboprop, versatile, efficient.', 
'A versatile twin-engine turboprop suitable for various missions.', 
'A twin-engine turboprop with versatile performance.', 4.5, 90, '../Img/baron-G58-charter.jpg'),

-- Plane 15: Piper M600
('Piper', 'M600', 2019, 'NM600', 6, 1400, 2200.00, 'available', 'Annual maintenance completed.', 
'Single-engine turboprop, advanced avionics, high efficiency.', 
'A single-engine turboprop with advanced avionics and high efficiency.', 
'A single-engine turboprop with high efficiency.', 4.6, 75, '../Img/2621927.jpg');




-- Mise à jour de la Table des Avions pour inclure la localisation de base


CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `plane_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `rental_date` date DEFAULT NULL,
  `rental_time` time NOT NULL,
  `departure_location` int(11) DEFAULT NULL,
  `arrival_location` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status_s` enum('confirmed','pending','canceled') DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bookings`
--



--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `plane_id` (`plane_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `departure_location` (`departure_location`),
  ADD KEY `arrival_location` (`arrival_location`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`plane_id`) REFERENCES `rental_planes` (`rental_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`departure_location`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`arrival_location`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE;
COMMIT;




INSERT INTO Locations (location_name, latitude, longitude, country, city, airport_code, description) 
VALUES 
-- Locations Fixes (pour les avions)
('Paris - Charles de Gaulle', 49.0097, 2.5479, 'France', 'Paris', 'CDG', 'Principal aéroport de Paris.'),
('Londres - Heathrow', 51.4700, -0.4543, 'Royaume-Uni', 'Londres', 'LHR', 'Principal aéroport de Londres.'),
('New York - JFK', 40.6413, -73.7781, 'États-Unis', 'New York', 'JFK', 'Principal aéroport de New York.'),
('Los Angeles - LAX', 33.9416, -118.4085, 'États-Unis', 'Los Angeles', 'LAX', 'Principal aéroport de Los Angeles.'),
('Tokyo - Haneda', 35.5494, 139.7798, 'Japon', 'Tokyo', 'HND', 'Principal aéroport de Tokyo.'),

-- Autres Locations
('San Francisco - SFO', 37.6213, -122.3790, 'États-Unis', 'San Francisco', 'SFO', 'Aéroport international de San Francisco.'),
('Amsterdam - Schiphol', 52.3105, 4.7683, 'Pays-Bas', 'Amsterdam', 'AMS', 'Principal aéroport des Pays-Bas.'),
('Hong Kong - HKG', 22.3080, 113.9185, 'Hong Kong', 'Hong Kong', 'HKG', 'Aéroport international de Hong Kong.'),
('Sydney - Kingsford Smith', -33.8688, 151.2093, 'Australie', 'Sydney', 'SYD', 'Principal aéroport de Sydney.'),
('Dubai - DXB', 25.2532, 55.3657, 'Émirats arabes unis', 'Dubai', 'DXB', 'Aéroport international de Dubai.'),

('Frankfurt - FRA', 50.0379, 8.5622, 'Allemagne', 'Francfort', 'FRA', 'Principal aéroport de Francfort.'),
('Madrid - MAD', 40.4168, -3.7038, 'Espagne', 'Madrid', 'MAD', 'Principal aéroport de Madrid.'),
('Barcelona - BCN', 41.2974, 2.0833, 'Espagne', 'Barcelone', 'BCN', 'Principal aéroport de Barcelone.'),
('Toronto - YYZ', 43.6777, -79.6248, 'Canada', 'Toronto', 'YYZ', 'Aéroport Pearson de Toronto.'),
('Singapore - SIN', 1.3644, 103.9915, 'Singapour', 'Singapour', 'SIN', 'Principal aéroport de Singapour.');


-- Les 5 lieux de départ prédéfinis
SET @location1 = 1;  -- Identifiant du premier lieu
SET @location2 = 2;  -- Identifiant du deuxième lieu
SET @location3 = 3;  -- Identifiant du troisième lieu
SET @location4 = 4;  -- Identifiant du quatrième lieu
SET @location5 = 5;  -- Identifiant du cinquième lieu

-- Mise à jour des avions avec une répartition équitable
-- Les trois premiers avions reçoivent le premier lieu
UPDATE Rental_planes SET base_location = @location1 WHERE rental_id IN (1, 2, 3);

-- Les trois suivants reçoivent le deuxième lieu
UPDATE Rental_planes SET base_location = @location2 WHERE rental_id IN (4, 5, 6);

-- Les trois suivants reçoivent le troisième lieu
UPDATE Rental_planes SET base_location = @location3 WHERE rental_id IN (7, 8, 9);

-- Les trois suivants reçoivent le quatrième lieu
UPDATE Rental_planes SET base_location = @location4 WHERE rental_id IN (10, 11, 12);

-- Les trois derniers reçoivent le cinquième lieu
UPDATE Rental_planes SET base_location = @location5 WHERE rental_id IN (13, 14, 15);
