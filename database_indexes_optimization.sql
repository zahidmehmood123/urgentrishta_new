-- Performance Optimization Indexes for Profile Query
-- Run this SQL to add indexes that will significantly improve query performance
-- These indexes are critical for the Profile::profiles() query with many LEFT JOINs

-- Index on users table for common filters and ordering
ALTER TABLE `users` ADD INDEX `idx_updated_at` (`updated_at`);
ALTER TABLE `users` ADD INDEX `idx_active` (`active`);
ALTER TABLE `users` ADD INDEX `idx_dataid` (`dataid`);

-- Index on masterdata table for JOINs (composite index for type + dataid)
ALTER TABLE `masterdata` ADD INDEX `idx_type_dataid` (`type`, `dataid`);

-- Index on images table for user_id and displaypic
ALTER TABLE `images` ADD INDEX `idx_user_id` (`user_id`);
ALTER TABLE `images` ADD INDEX `idx_user_displaypic` (`user_id`, `displaypic`);

-- If these indexes already exist, you can ignore the errors
-- To check existing indexes: SHOW INDEX FROM `table_name`;

