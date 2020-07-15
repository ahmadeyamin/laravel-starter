<?php

namespace App\Http\Controllers\Backend\Admin;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $this->humanFilesize($disk->size($f)),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
        return \view('backend.admin.backup.index',compact(['backups']));
    }

    function humanFilesize($size, $precision = 2) {
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $step = 1024;
        $i = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, $precision).$units[$i];
    }


    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run --only-db');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call

            return redirect()->back()->with('success','Backup Created :)');
        } catch (Exception $e) {
            // Flash::error($e->getMessage());
            return redirect()->withErrors('Somethings Is Wrong From System'.$e->getMessage());
        }
    }
    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download()
    {
        // return request();p
        if (!request()->has('path')) {
            abort(404, "The backup file doesn't exist.");
        }
        $file = config('laravel-backup.backup.name') . '/' . request()->path;
        return $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
        if ($disk->exists($file)) {
            return Storage::download($file);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    /**
     * Deletes a backup file.
     */
    public function delete()
    {
        if (!request()->has('path')) {
            abort(404, "The backup file doesn't exist.");
        }
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
        if ($disk->exists(config('laravel-backup.backup.name') . '/' . request()->path)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . request()->path);
            return redirect()->back()->with('success','Backup Deleted :)');
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}
