
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- fleet
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fleet`;

CREATE TABLE `fleet`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_game` INTEGER NOT NULL,
    `side` VARCHAR(250) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id` (`id`),
    UNIQUE INDEX `unique_index_fleets` (`id_game`, `side`),
    CONSTRAINT `fleet_ibfk_1`
        FOREIGN KEY (`id_game`)
        REFERENCES `game` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- game
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `game`;

CREATE TABLE `game`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `token` VARCHAR(250) DEFAULT '' NOT NULL,
    `difficulty` VARCHAR(250) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id` (`id`),
    UNIQUE INDEX `unique_index_games` (`id`, `token`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- history
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_game` INTEGER NOT NULL,
    `player` VARCHAR(250) DEFAULT '' NOT NULL,
    `x` INTEGER NOT NULL,
    `y` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id` (`id`),
    UNIQUE INDEX `unique_index_history` (`id_game`, `player`, `x`, `y`),
    CONSTRAINT `history_ibfk_1`
        FOREIGN KEY (`id_game`)
        REFERENCES `game` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ship
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ship`;

CREATE TABLE `ship`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_fleet` INTEGER NOT NULL,
    `type` VARCHAR(250) DEFAULT '' NOT NULL,
    `length` INTEGER NOT NULL,
    `startX` INTEGER NOT NULL,
    `startY` INTEGER NOT NULL,
    `direction` VARCHAR(250) DEFAULT '' NOT NULL,
    `coordinates` VARCHAR(500) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id` (`id`),
    UNIQUE INDEX `unique_index_ships` (`id`, `id_fleet`, `coordinates`),
    INDEX `id_fleet` (`id_fleet`),
    CONSTRAINT `ship_ibfk_1`
        FOREIGN KEY (`id_fleet`)
        REFERENCES `fleet` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
