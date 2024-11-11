CREATE TABLE IF NOT EXISTS the_social_network.user (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(16),
    birth_date DATE,
    registration_date DATE,
    about_me VARCHAR(4096) DEFAULT 'No info about this user'
);

CREATE TABLE IF NOT EXISTS the_social_network.user_data (
    user_id SERIAL PRIMARY KEY,
    hash_pass VARCHAR(60),
    FOREIGN KEY (user_id) REFERENCES the_social_network.user ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS the_social_network.chat_info (
    chat_id SERIAL PRIMARY KEY,
    chat_name VARCHAR(30)
);

CREATE TABLE IF NOT EXISTS the_social_network.chat (
    chat_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    PRIMARY KEY (chat_id, user_id),
    FOREIGN KEY (chat_id)   REFERENCES the_social_network.chat_info (chat_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (user_id)   REFERENCES the_social_network.user    (user_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS the_social_network.message (
    id SERIAL PRIMARY KEY,
    author_id INTEGER NOT NULL,
    chat_id INTEGER NOT NULL,
    date TIMESTAMP WITH TIME ZONE,
    message VARCHAR(4096),
    FOREIGN KEY (chat_id)   REFERENCES the_social_network.chat_info (chat_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES the_social_network.user    (user_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS the_social_network.friend_request (
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    status VARCHAR(16),
    status_change_date DATE,
    FOREIGN KEY (sender_id)   REFERENCES the_social_network.user (user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES the_social_network.user (user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY(sender_id, receiver_id)
);

CREATE TABLE IF NOT EXISTS the_social_network.group (
    group_id SERIAL PRIMARY KEY,
    group_name VARCHAR(30) UNIQUE NOT NULL,
    founder_id INTEGER NOT NULL,
    topic VARCHAR(20),
    FOREIGN KEY (founder_id) REFERENCES the_social_network.user (user_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS the_social_network.group_administrator (
    group_id INTEGER NOT NULL,
    admin_id INTEGER NOT NULL,
    FOREIGN KEY (group_id) REFERENCES the_social_network.group (group_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (admin_id) REFERENCES the_social_network.user (user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY(group_id, admin_id)
);

CREATE TABLE IF NOT EXISTS the_social_network.post (
    post_id SERIAL PRIMARY KEY,
    group_id INTEGER NOT NULL,
    author_id INTEGER NOT NULL,
    publication_date DATE,
    publication_text TEXT,
    FOREIGN KEY (group_id) REFERENCES the_social_network.group (group_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES the_social_network.user (user_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS the_social_network.group_member (
    group_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    FOREIGN KEY (group_id) REFERENCES the_social_network.group (group_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES the_social_network.user (user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY(group_id, user_id)
)
