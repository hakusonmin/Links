<?php

//createが競合するからかならず member(つまりcreateメソッドがある方)を上に書け..
require __DIR__.'/member.php';

require __DIR__.'/guest.php';

require __DIR__.'/settings.php';

require __DIR__.'/auth.php';



