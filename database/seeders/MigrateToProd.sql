
/**
 * Author:  Trygve
 * Created: 28 jan. 2022
 */
DELETE FROM `laravel`. `users`;
DELETE FROM `schedule`. `schedule`;

INSERT INTO `laravel`. `users` (`id`, `name`, `authority`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
   SELECT `id`, `name`, `authority`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at` FROM `sqdPrd`. `users`;
UPDATE `laravel`. `users`  SET authority=0;
UPDATE `laravel`. `users`  SET authority=1 WHERE id=6;

 /* Password=RevolveToAWave */
INSERT INTO `schedule`.`schedule` (`id`, `name`, `description`, `password`)
   SELECT `id`, `name`, `comment` ,'$2y$10$Vyj.n/AhuMGixXQq1TrkAe1VGd2ISTRJWPBMM4U3QDvsyjtvXslyK' FROM `sqdPrd`.`training`; 

INSERT INTO `schedule`.`schedule_date`(`id`, `schedule_id`, `schedule_date`, `start_time`, `comment`, `created_at`, `updated_at`)
   SELECT `id`, `training_id`, `training_date`, `start_time`, `comment`, `created_at`, `updated_at` FROM `sqdPrd`.`training_date`;

INSERT INTO `schedule`.`member_schedule`(`id`, `user_id`, `schedule_id`, `group_size`, `admin`, `created_at`, `updated_at`)
   SELECT `mt`.`id`, `mt`.`user_id`, `mt`.`training_id`, `u`.`group`,0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP
    FROM `sqdPrd`.`member_training` `mt`
    LEFT JOIN `sqdPrd`.`users` `u` ON `u`.`id`= `mt`.`user_id`;
/* Leif is admin */
UPDATE `schedule`.`member_schedule` SET admin=1 WHERE user_id=9;

INSERT INTO `schedule`.`member_schedule_date`(`id`, `user_id`, `schedule_date_id`, `status`, `created_at`, `updated_at`)
SELECT `id`, `user_id`, `training_date_id`, `status`, `created_at`, `updated_at` FROM `sqdPrd`.`member_training_date`
WHERE  training_date_id > 21;