CREATE TABLE RANKS(RANK_ID INT NOT NULL AUTO_INCREMENT, USER_ID INT, TOTAL_RANK_POINT VARCHAR(100), PRIMARY KEY(RANK_ID), FOREIGN KEY(USER_ID) REFERENCES USERS(USER_ID));

CREATE TABLE USERS(USER_ID INT NOT NULL AUTO_INCREMENT, USER_NAME VARCHAR(100), USER_PASSWORD VARCHAR(255),PRIMARY KEY(USER_ID));