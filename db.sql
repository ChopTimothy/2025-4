CREATE TABLE applications (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    fio VARCHAR(150) NOT NULL,
    tel VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    dat DATE NOT NULL,
    pol ENUM('G', 'M') NOT NULL,
    bio TEXT NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS languages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS application_languages (
    application_id INT UNSIGNED NOT NULL,
    language_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (application_id, language_id),
    FOREIGN KEY (application_id) REFERENCES applications(id) ON DELETE CASCADE,
    FOREIGN KEY (language_id) REFERENCES languages(id)
);