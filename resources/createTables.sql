CREATE TABLE IF NOT EXISTS the_social_network.members (
    user VARCHAR(16) PRIMARY KEY,
    pass VARCHAR(60),
    INDEX(user(6))
);

CREATE TABLE IF NOT EXISTS the_social_network.messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(16),
    recipent VARCHAR(16),
    date DATETIME,
    message VARCHAR(4096),
    INDEX(author(6)),
    INDEX(recipent(6))
);

CREATE TABLE IF NOT EXISTS friend_requests (
    sender VARCHAR(16),
    receiver VARCHAR(16),

    INDEX(sender(6)),
    INDEX(receiver(6))
);

CREATE TABLE IF NOT EXISTS the_social_network.friends (
    user VARCHAR(16),
    friend VARCHAR(16),
    INDEX(user(6)),
    INDEX(friend(6))
);

CREATE TABLE IF NOT EXISTS the_social_network.profiles (
    user VARCHAR(16) PRIMARY KEY,
    text VARCHAR(4096),

    INDEX(user(6))
);

