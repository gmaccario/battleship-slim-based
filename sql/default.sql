
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `ship`;
DROP TABLE IF EXISTS `fleet`;
DROP TABLE IF EXISTS `game`;

CREATE TABLE `game`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `token` VARCHAR(250) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id` (`id`),
    UNIQUE INDEX `unique_index_games` (`id`, `token`)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE `fleet`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
	`id_game` INTEGER NOT NULL,
    `side` VARCHAR(250) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id` (`id`),
    UNIQUE INDEX `unique_index_fleets` (`id_game`, `side`),
	CONSTRAINT FOREIGN KEY (id_game) REFERENCES game (id) 
		ON DELETE CASCADE 
		ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE `ship`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
	`id_fleet` INTEGER NOT NULL,
    `type` VARCHAR(250) DEFAULT '' NOT NULL,
	`length` INTEGER NOT NULL,
	`startX` INTEGER NOT NULL,
	`startY` INTEGER NOT NULL,
	`direction` VARCHAR(250) DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id` (`id`),
    UNIQUE INDEX `unique_index_ships` (`id`, `id_fleet`),
	CONSTRAINT FOREIGN KEY (id_fleet) REFERENCES fleet (id) 
		ON DELETE CASCADE 
		ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_unicode_ci;


# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
