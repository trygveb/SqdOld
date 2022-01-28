/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Trygve
 * Created: 28 jan. 2022
 */
DELETE FROM `laravelTest`. `users`;
DELETE FROM `scheduleTest`. `schedule`;
SELECT * FROM `sqdPrd`. `users`;
INSERT INTO `laravelTest`. `users` (`id`, `name`, `authority`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) SELECT `id`, `name`, `authority`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at` FROM `sqdPrd`. `users`;
UPDATE `laravelTest`. `users`  SET authority=0;
UPDATE `laravelTest`. `users`  SET authority=1 WHERE id=6;
INSERT INTO `scheduleTest`.`schedule` (`id`, `name`, `description`, `password`) SELECT `id`, `name`, `comment` ,'$2y$10$Vyj.n/AhuMGixXQq1TrkAe1VGd2ISTRJWPBMM4U3QDvsyjtvXslyK' FROM `sqdPrd`.`training`;  // Password=RevolveToAWave

