--<ScriptOptions statementTerminator=";"/>

CREATE TABLE `timing_block` (
	`blockId` INT NOT NULL AUTO_INCREMENT,
	`blockName` VARCHAR(50),
	`blockDescription` VARCHAR(100),
	`blockFoundation` INT,
	`blockStatus` SMALLINT UNSIGNED,
	`builderId` INT NOT NULL,
	PRIMARY KEY (`blockId`)
);

CREATE TABLE `timing_brick` (
	`brickId` INT NOT NULL AUTO_INCREMENT,
	`brickStart` INT,
	`brickDuration` INT,
	`brickContent` VARCHAR(100),
	`blockId` INT NOT NULL,
	PRIMARY KEY (`brickId`)
);

CREATE TABLE `timing_builder` (
	`builderId` INT NOT NULL AUTO_INCREMENT,
	`builderUsername` VARCHAR(25) NOT NULL,
	`builderPassword` CHAR(32) NOT NULL,
	`builderEmail` VARCHAR(40) NOT NULL,
	PRIMARY KEY (`builderId`)
);

ALTER TABLE `timing_block` ADD CONSTRAINT `timing_block_timing_builder_FK` FOREIGN KEY (`builderId`)
	REFERENCES `timing_builder` (`builderId`)
	ON DELETE CASCADE;

ALTER TABLE `timing_brick` ADD CONSTRAINT `timimg_brick_timing_block_FK` FOREIGN KEY (`blockId`)
	REFERENCES `timing_block` (`blockId`)
	ON DELETE CASCADE;

