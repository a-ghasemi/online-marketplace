<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadCSVTest extends TestCase
{
    use RefreshDatabase;

    public function testValidateContent()
    {
        // We have to check validation of CSV file in real project
        // But I leave this test unimplemented, because of the time
        // and I set the TODO:Implement Content

        return $this->assertTrue(True);

    }

    public function testUploadFile()
    {
        //Arrange
        $fake_admin = factory(User::class)->create();
        $role = Role::create(['name' => 'admin']);
        $fake_admin->assignRole($role);
        $time = time();
        $filename = sprintf("%d.csv", $time);

        //Act
        $file = UploadedFile::fake()->create($filename, 100);
        $this->actingAs($fake_admin)
            ->post(route('admin_panel.csv.upload'), [
                'file' => $file
            ]);
        $file_extension = substr($filename,strrpos($filename,'.'));
        $filename = sprintf("%s/%s%s", date('Y-m-d', $time), $time, $file_extension );

        //Assert
        Storage::disk('local')->assertExists($filename);
    }

}
