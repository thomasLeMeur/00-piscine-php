#!/usr/bin/php
<?PHP
passthru('echo \'#include <utmpx.h>\n#include <stdio.h>\n#include <string.h>\nint main(){int ref=-1;struct utmpx *a=getutxent();char buf[15];buf[14] = 0;while ((a = getutxent())){if (ref == -1)ref = a->ut_type;if (a->ut_type == ref){strftime(buf, 14, " %b  %d %H:%M", localtime(&a->ut_tv.tv_sec));memcpy(buf + 6, buf + 7, 8);printf("%s %s %s%c", a->ut_user, a->ut_line, buf, 10);}}}\' > tmp.c && gcc tmp.c && ./a.out && rm -f a.out tmp.c');
?>
