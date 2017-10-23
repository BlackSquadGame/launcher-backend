@echo off
TITLE Modifying your HOSTS file
COLOR F0
ECHO.
:-------------------------------------
>nul 2>&1 "%SYSTEMROOT%\system32\cacls.exe" "%SYSTEMROOT%\system32\config\system"
if '%errorlevel%' NEQ '0' (
    echo Requesting administrative privileges...
    goto UACPrompt
) else ( goto gotAdmin )
:UACPrompt
    echo Set UAC = CreateObject^("Shell.Application"^) > "%temp%\getadmin.vbs"
    set params = %*:"="
    echo UAC.ShellExecute "cmd.exe", "/c %~s0 %params%", "", "runas", 1 >> "%temp%\getadmin.vbs"
    "%temp%\getadmin.vbs"
    del "%temp%\getadmin.vbs"
    exit /B
:gotAdmin
    pushd "%CD%"
    CD /D "%~dp0"
:--------------------------------------
setlocal enabledelayedexpansion
set LIST=(stage.blacksquad.com)
set stage.blacksquad.com=127.0.0.1
set _list=%LIST:~1,-1%
for  %%G in (%_list%) do (
    set  _name=%%G
    set  _value=!%%G!
    SET NEWLINE=^& echo.
    ECHO Carrying out requested modifications to your HOSTS file
    type %WINDIR%\System32\drivers\etc\hosts | findstr /v !_name! > tmp.txt
    ECHO %NEWLINE%^!_value! !_name!>>tmp.txt
    copy /b/v/y tmp.txt %WINDIR%\System32\drivers\etc\hosts
    del tmp.txt
)
ipconfig /flushdns
ECHO.
ECHO.
ECHO Finished, you may close this window now.
GOTO END
:END
ECHO.
ping -n 11 192.0.2.2 > nul
EXIT