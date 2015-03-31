<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(new DbClean);
Artisan::add(new dbfix);
Artisan::add(new ImportAll);
Artisan::add(new ImportFast);
Artisan::add(new ImportNew);
Artisan::add(new ImportNews);
Artisan::add(new ForceDeltaRecalculation);
