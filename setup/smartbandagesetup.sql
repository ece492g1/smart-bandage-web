DROP TABLE IF EXISTS new_alerts;
DROP TABLE IF EXISTS archived_alerts;
DROP TABLE IF EXISTS bandage_record;
DROP TABLE IF EXISTS humidity_record;
DROP TABLE IF EXISTS temp_record;
DROP TABLE IF EXISTS moisture_record;
DROP TABLE IF EXISTS subscriptions;
DROP TABLE IF EXISTS patient;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  provider_id INT(5) UNSIGNED AUTO_INCREMENT,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(30) NOT NULL,
  user_type CHAR(1) NOT NULL,
  active_status boolean NOT NULL,
  CHECK (user_type in ('a', 'n')),
  PRIMARY KEY (provider_id),
  UNIQUE (email)
);

CREATE TABLE login_history (
  provider_id INT(5) UNSIGNED NOT NULL,
  login_date DATETIME,
  FOREIGN KEY (provider_id) REFERENCES users(provider_id)
);

CREATE TABLE patient (
  patient_id INT(5) UNSIGNED AUTO_INCREMENT,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  PRIMARY KEY (patient_id)
);

CREATE TABLE subscriptions (
  care_provider INT(5) UNSIGNED NOT NULL,
  patient_id INT(5) UNSIGNED NOT NULL,
  PRIMARY KEY (care_provider,patient_id),
  FOREIGN KEY (care_provider) REFERENCES users(provider_id),
  FOREIGN KEY (patient_id) REFERENCES patient(patient_id)
);

CREATE TABLE humidity_record (
  record_id INT(10) UNSIGNED NOT NULL,
  patient_id INT(5) UNSIGNED NOT NULL,
  bandage_id INT(5) UNSIGNED NOT NULL,
  creation_time DATETIME,
  value FLOAT(8,4) NOT NULL,
  PRIMARY KEY (record_id),
  FOREIGN KEY (patient_id) REFERENCES patient(patient_id)
);

CREATE TABLE temp_record (
  record_id INT(10) UNSIGNED NOT NULL,
  patient_id INT(5) UNSIGNED NOT NULL,
  bandage_id INT(5) UNSIGNED NOT NULL,
  creation_time DATETIME,
  value FLOAT(8,4) NOT NULL,
  PRIMARY KEY (record_id),
  FOREIGN KEY (patient_id) REFERENCES patient(patient_id)
);

CREATE TABLE moisture_record (
  record_id INT(10) UNSIGNED NOT NULL,
  patient_id INT(5) UNSIGNED NOT NULL,
  bandage_id INT(5) UNSIGNED NOT NULL,
  creation_time DATETIME,
  value FLOAT(8,4) NOT NULL,
  PRIMARY KEY (record_id),
  FOREIGN KEY (patient_id) REFERENCES patient(patient_id)
);

CREATE TABLE bandage_record (
  record_id INT(10) UNSIGNED NOT NULL,
  patient_id INT(5) UNSIGNED NOT NULL,
  bandage_id INT(5) UNSIGNED NOT NULL,
  creation_time DATETIME,
  value FLOAT(8,4) NOT NULL,
  PRIMARY KEY (record_id),
  FOREIGN KEY (patient_id) REFERENCES patient(patient_id)
);

CREATE TABLE new_alerts (
  record_id INT(10) UNSIGNED NOT NULL,
  patient_id INT(5) UNSIGNED NOT NULL,
  bandage_id INT(5) UNSIGNED NOT NULL,
  alert_type CHAR(1) NOT NULL,
  creation_time DATETIME,
  viewed boolean NOT NULL,
  viewed_by_user INT(5) UNSIGNED NOT NULL,
  CHECK (alert_type in ('h','t','m','r')),
  value FLOAT(8,4) NOT NULL,
  PRIMARY KEY (record_id),
  FOREIGN KEY (patient_id) REFERENCES patient(patient_id),
  FOREIGN KEY (viewed_by_user) REFERENCES users(provider_id)
);

CREATE TABLE archived_alerts (
  record_id INT(10) UNSIGNED NOT NULL,
  patient_id INT(5) UNSIGNED NOT NULL,
  bandage_id INT(5) UNSIGNED NOT NULL,
  alert_type CHAR(1) NOT NULL,
  creation_time DATETIME,
  viewed boolean NOT NULL,
  viewed_by_user INT(5) UNSIGNED NOT NULL,
  CHECK (alert_type in ('h','t','m','r')),
  value FLOAT(8,4) NOT NULL,
  PRIMARY KEY (record_id),
  FOREIGN KEY (patient_id) REFERENCES patient(patient_id),
  FOREIGN KEY (viewed_by_user) REFERENCES users(provider_id)
);
