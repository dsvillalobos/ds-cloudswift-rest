CREATE DATABASE dscloudswift;
USE dscloudswift;

CREATE TABLE users (
    UserID INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    PRIMARY KEY (UserID)
);

CREATE TABLE files (
    FileID INT NOT NULL AUTO_INCREMENT,
    FileName VARCHAR(255) NOT NULL,
    FileType VARCHAR(10) NOT NULL,
    MimeType VARCHAR(50) NOT NULL,
    FileData LONGBLOB NOT NULL,
    Date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Time TIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UserID INT NOT NULL,
    PRIMARY KEY (FileID),
    FOREIGN KEY (UserID)
        REFERENCES users (UserID)
);

CREATE TABLE links (
    LinkID INT NOT NULL AUTO_INCREMENT,
    LinkName VARCHAR(255) NOT NULL,
    LinkAddress TEXT NOT NULL,
    Date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Time TIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UserID INT NOT NULL,
    PRIMARY KEY (LinkID),
    FOREIGN KEY (UserID)
        REFERENCES users (UserID)
);

CREATE TABLE notes (
    NoteID INT NOT NULL AUTO_INCREMENT,
    NoteTitle VARCHAR(255) NOT NULL,
    NoteBody TEXT NOT NULL,
    Date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Time TIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UserID INT NOT NULL,
    PRIMARY KEY (NoteID),
    FOREIGN KEY (UserID)
        REFERENCES users (UserID)
);

CREATE VIEW files_view AS
    SELECT 
        files.FileID AS FileID,
        files.FileName AS FileName,
        files.FileType AS FileType,
        files.MimeType AS MimeType,
        files.FileData AS FileData,
        files.Date AS Date,
        files.Time AS Time,
        files.UserID AS UserID,
        users.Name AS Name,
        users.LastName AS LastName,
        users.Email AS Email
    FROM
        files
            INNER JOIN
        users ON files.UserID = users.UserID;

CREATE VIEW links_view AS
    SELECT 
        links.LinkID AS LinkID,
        links.LinkName AS LinkName,
        links.LinkAddress AS LinkAddress,
        links.Date AS Date,
        links.Time AS Time,
        links.UserID AS UserID,
        users.Name AS Name,
        users.LastName AS LastName,
        users.Email AS Email
    FROM
        links
            INNER JOIN
        users ON links.UserID = users.UserID;

CREATE VIEW notes_view AS
    SELECT 
        notes.NoteID AS NoteID,
        notes.NoteTitle AS NoteTitle,
        notes.NoteBody AS NoteBody,
        notes.Date AS Date,
        notes.Time AS Time,
        notes.UserID AS UserID,
        users.Name AS Name,
        users.LastName AS LastName,
        users.Email AS Email
    FROM
        notes
            INNER JOIN
        users ON notes.UserID = users.UserID;
