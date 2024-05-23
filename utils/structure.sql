DROP DATABASE IF EXISTS bdd_journal;

CREATE DATABASE bdd_journal;

USE bdd_journal;

DROP TABLE IF EXISTS `annonce`;

CREATE TABLE `annonce` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `imageUrl` varchar(250) DEFAULT NULL,
    `contenu` text NOT NULL,
    `titre` varchar(250) NOT NULL,
    `auteur` varchar(250) NOT NULL,
    `datePublication` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `annonce_id_uindex` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

DROP TABLE IF EXISTS `utilisateur`;

CREATE TABLE `utilisateur` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(250) NOT NULL,
    `nom` varchar(250) NOT NULL,
    `prenom` varchar(250) NOT NULL,
    `password` varchar(250) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `utilisateur_id_uindex` (`id`),
    UNIQUE KEY `utilisateur_login_uindex` (`username`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
    `utilisateur` (
        `username`,
        `nom`,
        `prenom`,
        `password`
    )
VALUES (
        'jose',
        'bove',
        'jose',
        '$2y$10$4XkN4nd5J6afG5fxmfcQq.N.yIoTtfgkXDDr8SueYQMTMFoyEq5cW'
    )