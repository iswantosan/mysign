-- =====================================================================
-- 2026-08-13_monitoring_kontrak_access.sql
-- Whitelist for non-admin users allowed to open Monitoring Kontrak
-- dashboard at /module_contract/employee/monitoring_kontrak.
-- Admin CRUD-s this table from /module_contract/admin/data_akses_monitoring_kontrak.
-- Employee route checks employee_in_id membership before rendering.
-- =====================================================================

USE `patlog__contract`;

DROP TABLE IF EXISTS `entity__monitoring_kontrak_access`;
CREATE TABLE `entity__monitoring_kontrak_access` (
    `mka_id`                bigint NOT NULL AUTO_INCREMENT,
    `employee_in_id`        bigint NOT NULL COMMENT 'FK patlog__hrms.entity__employee_in.employee_in_id',
    `employee_in_code`      varchar(255) DEFAULT NULL,
    `employee_in_name`      varchar(255) DEFAULT NULL,
    `employee_in_position`  varchar(255) DEFAULT NULL,
    `employee_in_division`  varchar(255) DEFAULT NULL,
    `granted_by_id`         bigint DEFAULT NULL,
    `granted_by_name`       varchar(255) DEFAULT NULL,
    `mka_note`              text DEFAULT NULL,
    `mka_insert`            datetime DEFAULT CURRENT_TIMESTAMP,
    `mka_update`            timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`mka_id`),
    UNIQUE KEY `uk_employee` (`employee_in_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
