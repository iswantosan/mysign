-- =====================================================================
-- 2026-08-01_sirkulir_attachment_history.sql
-- Adds entity__request_employee_attachment_history to record every
-- replacement of a request attachment during the sirkulir resubmit flow.
-- Mirrors the pattern used by entity__request_document_history in
-- patlog__procurement (2026-08-01_procurement_doc_history.sql).
-- =====================================================================

USE `patlog__request_employee`;

DROP TABLE IF EXISTS `entity__request_employee_attachment_history`;
CREATE TABLE `entity__request_employee_attachment_history` (
    `attachment_history_id`         bigint NOT NULL AUTO_INCREMENT,
    `request_employee_attachment_id` bigint DEFAULT NULL,
    `request_employee_id`           bigint DEFAULT NULL,
    `sirkulasi_id`                  bigint DEFAULT NULL COMMENT 'sirkulasi row that triggered the resubmit, if any',
    `attachment_history_file`       varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'archived old file name',
    `attachment_history_action`     varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'resubmit' COMMENT 'resubmit | replace | delete',
    `attachment_history_by_id`      bigint DEFAULT NULL,
    `attachment_history_by_name`    varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
    `attachment_history_by_role`    varchar(32)  CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'requester | approver | admin',
    `attachment_history_note`       text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
    `attachment_history_revision_no` int DEFAULT NULL COMMENT 'revision cycle number this replacement belongs to',
    `attachment_history_created_date` datetime DEFAULT NULL,
    PRIMARY KEY (`attachment_history_id`) USING BTREE,
    KEY `idx_ah_attachment` (`request_employee_attachment_id`),
    KEY `idx_ah_request`    (`request_employee_id`),
    KEY `idx_ah_sirkulasi`  (`sirkulasi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
