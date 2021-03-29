@echo off
IF %1 == generate (
	php %~dp0generator.php %*
) ELSE (
	echo 'AAA'
)

