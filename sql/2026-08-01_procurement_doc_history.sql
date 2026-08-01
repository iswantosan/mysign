-- =====================================================================
-- 2026-08-01_procurement_doc_history.sql
-- Adds:
--   1. entity__request_document_history : versioned history of every
--      upload/replace to entity__request_document (loket admin inject
--      + user re-upload during process_procurement).
--   2. request_log_duration_seconds column on entity__request_log :
--      populated when PIC procurement returns a request back to the
--      user (log_status='Back'), value = seconds between the request
--      being assigned (request_proc_date_start) and the return event.
-- =====================================================================

USE `patlog__procurement`;

-- ---------------------------------------------------------------------
-- 1. Document history table
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `entity__request_document_history`;
CREATE TABLE `entity__request_document_history` (
    `request_document_history_id`           bigint NOT NULL AUTO_INCREMENT,
    `request_document_id`                   bigint DEFAULT NULL COMMENT 'NULL untuk kind=loket_process',
    `request_id`                            bigint DEFAULT NULL,
    `request_document_history_kind`         varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'document' COMMENT 'document (entity__request_document) | loket_process (entity__request.request_process_document)',
    `request_document_history_file`         varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'Nama file versi lama yang di-archive',
    `request_document_history_action`       varchar(32)  CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'upload | replace',
    `request_document_history_by_id`        bigint DEFAULT NULL,
    `request_document_history_by_name`      varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
    `request_document_history_by_role`      varchar(32)  CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'admin | employee | loket',
    `request_document_history_note`         text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
    `request_document_history_created_date` datetime DEFAULT NULL,
    PRIMARY KEY (`request_document_history_id`) USING BTREE,
    KEY `idx_rdh_document` (`request_document_id`),
    KEY `idx_rdh_request`  (`request_id`),
    KEY `idx_rdh_kind`     (`request_document_history_kind`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ---------------------------------------------------------------------
-- 2. Duration column on request log
-- ---------------------------------------------------------------------
ALTER TABLE `entity__request_log`
    ADD COLUMN `request_log_duration_seconds` bigint DEFAULT NULL
        COMMENT 'Durasi (detik) dari assign PIC procurement s/d event ini. Diisi untuk log status=Back.'
        AFTER `request_log_created_date`;
