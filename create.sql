CREATE TABLE ACCOUNT(
USERNAME char(100) CONSTRAINT PKACCOUNT PRIMARY KEY,
PASSWORD char(100) CONSTRAINT NN_PW NOT NULL,
ACCOUNT_EMAIL_ADDRESS char(100) CONSTRAINT NN_ACCOUNT_EMAIL_ADDRESS
NOT NULL);
