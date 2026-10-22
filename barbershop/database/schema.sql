
CREATE TABLE users(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(10)  NULL,
    password VARCHAR(200) NOT NULL ,
    role ENUM('user','admin') NOT NULL DEFAULT'user',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     is_active TINYINT(1) NOT NULL DEFAULT 1
);

CREATE TABLE time_slots(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slot_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,

    capacity INT UNSIGNED NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY uq_slot (slot_date, start_time, end_time),
    CONSTRAINT chk_capacity CHECK (capacity > 0),
    CONSTRAINT chk_times CHECK (end_time > start_time)


    );

CREATE TABLE reservations (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  slot_id INT UNSIGNED NOT NULL,
  note VARCHAR(255) NULL,
  status ENUM('pending','confirmed','rejected','cancelled')
    NOT NULL DEFAULT 'pending',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_res_user FOREIGN KEY (user_id)
    REFERENCES users(id) ON DELETE RESTRICT,
  CONSTRAINT fk_res_slot FOREIGN KEY (slot_id)
    REFERENCES time_slots(id) ON DELETE RESTRICT,
    INDEX idx_slot_status (slot_id, status)
 
) ;



INSERT INTO users (name, email, password, role) VALUES
('Admin',  'admin@barbershop.test', 'HASH_HERE', 'admin'),
('Ahmad',  'ahmad@barbershop.test', 'HASH_HERE', 'user'),
('Sara',   'sara@barbershop.test',  'HASH_HERE', 'user');

INSERT INTO time_slots (slot_date, start_time, end_time, capacity) VALUES
(CURDATE() - INTERVAL 1 DAY, '10:00', '11:00', 2), 
(CURDATE() + INTERVAL 1 DAY, '10:00', '11:00', 2),
(CURDATE() + INTERVAL 1 DAY, '11:00', '12:00', 1),
(CURDATE() + INTERVAL 2 DAY, '14:00', '15:00', 3),
(CURDATE() + INTERVAL 3 DAY, '16:00', '17:00', 2);
