INSERT INTO `users` (`provider_id`, `first_name`, `last_name`, `email`, `password`, `user_type`, `active_status`) VALUES
(1, 'Jared', 'Cuglietta', 'cugliettaadmin', 'letmein', 'a', NULL),
(2, 'Jared', 'Cuglietta', 'cugliettanurse', 'hello', 'n', NULL),
(3, 'Jenna', 'Hatchard', 'hatchardadmin', 'changeMe', 'a', NULL),
(4, 'Jenna', 'Hatchard', 'hatchardnurse', 'changeMe', 'n', NULL),
(5, 'Mike', 'Blouin', 'blouinadmin', 'changeMe', 'a', NULL),
(6, 'Mike', 'Blouin', 'blouinnurse', 'changeMe', 'n', NULL),
(7, 'Capstone', 'Instructor', 'capstoneadmin', 'changeMe', 'a', NULL),
(8, 'Capstone', 'Instructor', 'capstonenurse', 'changeMe', 'n', NULL);

INSERT INTO `patient` (`patient_id`, `first_name`, `last_name`) VALUES
(2, 'Jane', 'Doe'),
(1, 'John', 'Doe');

INSERT INTO `subscriptions` (`care_provider`, `patient_id`) VALUES
(2, 1),
(2, 2);

INSERT INTO `temp_record` (`record_id`, `bandage_id`, `creation_time`, `value`) VALUES
(1, 88, '2016-03-15 11:02:23', 23.4500),
(2, 88, '2016-03-15 11:02:58', 24.7500),
(3, 88, '2016-03-15 11:09:56', 23.2500),
(4, 88, '2016-03-15 11:10:05', 23.1000),
(5, 88, '2016-03-15 18:16:32', 26.2500),
(6, 88, '2016-03-15 13:16:23', 27.0000),
(7, 88, '2016-03-15 12:16:17', 24.2500),
(8, 88, '2016-03-15 11:17:06', 26.5000),
(9, 88, '2016-03-15 11:16:03', 24.5000),
(10, 88, '2016-03-15 11:15:58', 24.7000),
(11, 88, '2016-03-15 11:15:53', 24.9000),
(12, 88, '2016-03-15 11:15:49', 28.4000),
(13, 88, '2016-03-15 11:15:45', 23.9000),
(14, 88, '2016-03-15 11:15:41', 23.7500),
(16, 88, '2016-03-15 13:51:05', 40.0000);
