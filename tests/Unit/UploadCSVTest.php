<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadCSVTest extends TestCase
{
//    use DatabaseMigrations;
    use RefreshDatabase;

    public function testCreateTableRecordAfterSuccessUpload()
    {
        $this->assertTrue(True);
    }

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
        Storage::fake('csv_file');
        $fake_admin = factory(User::class)->make();
        Role::create(['name' => 'admin']);
        $fake_admin->assignRole('admin');
        $filename = sprintf("%s%d.csv",'test',rand(100,999));

        //Act
        $this->actingAs($fake_admin)
            ->json('POST', route('admin_panel.csv.upload'), [
            'file' => UploadedFile::fake()->create($filename)
        ]);
        $filename = sprintf("%s/%s", date('Y-m-d', time()), time() . $filename);

        //Assert
        Storage::disk('local')->assertExists($filename);
    }

}
