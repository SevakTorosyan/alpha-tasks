SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

-- Вывести логин и фио пользователя без посещений
SELECT u.LOGIN, u.FIO
FROM USERS_TAB u
LEFT JOIN LOG_TAB l ON u.LOGIN = l.USER_LOGIN
GROUP BY l.USER_LOGIN
HAVING COUNT(l.USER_LOGIN) = 0

-- Вывести страницы которую используются департаментами
SELECT DISTINCT d.DEP_NAME, l.PAGE_NAME
FROM DEPARTMENT_TAB d
JOIN USERS_TAB u ON d.DEP_ID = u.DEPARTMENT_ID
JOIN LOG_TAB l ON l.USER_LOGIN = u.LOGIN
ORDER BY d.DEP_NAME

-- Вывести департаменты, которые активнее всего пользуются account.php
SELECT DEPARTMENT_TAB.DEP_NAME, SUM(user.COUNT) as 'VISITS COUNT'
FROM (
    SELECT l.USER_LOGIN, COUNT(*) as COUNT
	FROM LOG_TAB l
	WHERE l.PAGE_NAME = 'account.php'
	GROUP BY l.USER_LOGIN
) user
JOIN USERS_TAB ON user.USER_LOGIN = USERS_TAB.LOGIN
JOIN DEPARTMENT_TAB ON USERS_TAB.DEPARTMENT_ID = DEPARTMENT_TAB.DEP_ID
GROUP BY USERS_TAB.DEPARTMENT_ID
ORDER BY SUM(user.COUNT) DESC