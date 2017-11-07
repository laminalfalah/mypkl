<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Tour;
use App\Models\Umroh;
use App\Models\Profile;
use App\Models\Article;
use App\Models\Slideshows;
use App\Models\Permission;

class Sako extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lor = '<h1>Lorem Ipsum</h1>
<h4>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</h4>
<h5>"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</h5>
<hr />
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sit amet laoreet nisi. Sed commodo fermentum velit non varius. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam lobortis purus nec dui luctus, et euismod nibh luctus. Donec gravida ac dui non rhoncus. Donec molestie in augue sed ullamcorper. Integer cursus sagittis augue ut pharetra. Quisque in lacinia eros, id condimentum felis. Duis ornare risus eu arcu fermentum, vitae aliquam arcu suscipit. Donec tempus est sed consequat euismod. Vestibulum hendrerit faucibus arcu, a fringilla nisl sagittis a. Vivamus velit erat, finibus vitae elit ac, malesuada suscipit ex. Vivamus eu enim consectetur, convallis massa nec, congue urna. Phasellus quis quam a velit facilisis elementum. Proin lacinia euismod dui sit amet rhoncus. Nulla dolor enim, mattis at lacus in, finibus lacinia sem.</p>
<p>In id tempus magna. In et erat id ex tempus feugiat fermentum a lorem. Morbi mi mauris, efficitur sodales ultrices nec, blandit ut justo. Etiam fermentum tortor eu nisi varius luctus. Etiam mauris magna, bibendum et lacinia quis, sodales at nisi. Sed nulla magna, vulputate vel nibh eget, blandit auctor orci. Proin suscipit, leo id tempus dignissim, ipsum turpis fermentum ipsum, vel egestas massa eros quis erat. Donec tincidunt volutpat justo, cursus consequat libero commodo non. Ut lectus libero, placerat pellentesque risus non, aliquam blandit nibh. In imperdiet ac nunc ac mattis. Vestibulum gravida fermentum dolor sit amet fringilla. Cras nunc sapien, sollicitudin luctus consectetur sit amet, varius in massa. Nulla molestie elit quis interdum luctus.</p>
<p>Curabitur pellentesque sem eu odio posuere dignissim sed sed mi. Etiam tempus erat ultrices egestas posuere. Sed odio dui, sodales eget urna at, elementum dapibus nunc. Ut eget dui nec nisl consequat rhoncus consequat vitae odio. Aliquam ac tincidunt lacus. Integer posuere et tellus non ullamcorper. Cras justo odio, lacinia sed dignissim non, suscipit vitae massa. Vivamus nec consequat elit, quis feugiat magna. Ut ac viverra neque. Etiam massa nisi, aliquet sit amet nibh sed, dignissim dictum tortor. Praesent gravida ex nec urna sodales, ac volutpat nibh scelerisque. Quisque egestas sodales augue non maximus.</p>
<p>Donec convallis sed nisi rhoncus vulputate. Curabitur in fermentum purus. Quisque posuere, sem sit amet elementum vestibulum, justo odio sagittis eros, ac pulvinar orci enim a diam. Cras vitae maximus diam. Nam ullamcorper quam sit amet tincidunt fermentum. Aenean malesuada, magna a tincidunt euismod, ipsum arcu semper urna, at dapibus leo enim quis justo. Nullam id faucibus nisl. Cras accumsan vestibulum erat, sit amet vestibulum lorem convallis non. Mauris dignissim vel sapien quis hendrerit. Nullam fringilla, ligula vitae porttitor ultrices, ante risus congue purus, sit amet sodales tortor nisi vel mauris. Morbi sagittis orci a suscipit bibendum. Mauris nec ligula auctor, elementum nisl vitae, pharetra erat.</p>
<p>Maecenas pellentesque dui quis pharetra finibus. Aliquam nec luctus ante. Curabitur interdum gravida lacus, sit amet lacinia felis convallis sit amet. Cras quam lectus, consectetur a porta quis, porta ut velit. Pellentesque eu luctus orci. Mauris gravida odio quis rutrum luctus. Maecenas consequat ante eget erat posuere vehicula. Suspendisse sed ipsum tristique, scelerisque ante id, consectetur neque. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi dignissim lectus eget orci tristique efficitur. Etiam rutrum quis risus eget mattis. Duis vel mollis lorem.</p>';

        $createRoles = new Permission;
        $createRoles->name = 'create_roles';
        $createRoles->display_name= 'Create Roles';
        $createRoles->description = 'Create Roles';
        $createRoles->save();

        $readRoles = new Permission;
        $readRoles->name = 'read_roles';
        $readRoles->display_name= 'Read Roles';
        $readRoles->description = 'Read Roles';
        $readRoles->save();

        $updateRoles = new Permission;
        $updateRoles->name = 'update_roles';
        $updateRoles->display_name= 'Update Roles';
        $updateRoles->description = 'Update Roles';
        $updateRoles->save();

        $deleteRoles = new Permission;
        $deleteRoles->name = 'delete_roles';
        $deleteRoles->display_name= 'Delete Roles';
        $deleteRoles->description = 'Delete Roles';
        $deleteRoles->save();

        $createPosts = new Permission;
        $createPosts->name = 'create_posts';
        $createPosts->display_name= 'Create Posts';
        $createPosts->description = 'Create Posts';
        $createPosts->save();

        $readPosts = new Permission;
        $readPosts->name = 'read_posts';
        $readPosts->display_name= 'Read Posts';
        $readPosts->description = 'Read Posts';
        $readPosts->save();

        $updatePosts = new Permission;
        $updatePosts->name = 'update_posts';
        $updatePosts->display_name= 'Update Posts';
        $updatePosts->description = 'Update Posts';
        $updatePosts->save();

        $deletePosts = new Permission;
        $deletePosts->name = 'delete_posts';
        $deletePosts->display_name= 'Delete Posts';
        $deletePosts->description = 'Delete Posts';
        $deletePosts->save();

        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->display_name = "Administrator";
        $adminRole->description = "Only Administrator";
        $adminRole->save();
        $adminRole->attachPermissions([
          $createPosts,$readPosts,$updatePosts,$deletePosts,
          $createRoles,$readRoles,$updateRoles,$deleteRoles
        ]);

        $operatorRole = new Role();
        $operatorRole->name = "operator";
        $operatorRole->display_name = "Operator";
        $operatorRole->description = "Operator For Services Booking";
        $operatorRole->save();
        $operatorRole->attachPermissions([
          $createPosts,$readPosts,$updatePosts,$deletePosts
        ]);

        $companyRole = new Role();
        $companyRole->name = "company";
        $companyRole->display_name = "Company";
        $companyRole->description = "Only People Company";
        $companyRole->save();
        $companyRole->attachPermissions([
          $createPosts,$readPosts,$updatePosts,$deletePosts
        ]);

        $admin = new User();
        $admin->name = 'Laminal Admin';
        $admin->email = 'laminalfalah08@gmail.com';
        $admin->password = bcrypt('admin123');
        $admin->status = "Activated";
        $admin->save();
        $admin->attachRole($adminRole);

        $operator = new User();
        $operator->name = 'Laminal Operator';
        $operator->email = 'laminalfalah.lf@gmail.com';
        $operator->password = bcrypt('admin123');
        $operator->status = "Activated";
        $operator->save();
        $operator->attachRole($operatorRole);

        $company = new User();
        $company->name = 'Laminal Company';
        $company->email = 'laminalfalah@yahoo.co.id';
        $company->password = bcrypt('admin123');
        $company->status = "Activated";
        $company->save();
        $company->attachRole($companyRole);

        $usr = User::all()->count();
        for ($i=1; $i <= $usr; $i++) {
          $profil = Profile::create([
            'user_id' => $i,
            'place_of_birth' => 'Surabaya',
            'date_of_birth' => '1995-06-26',
            'sex' => 'Male',
            'religion' => 'Islam',
            'status_marriage' => 'Single',
            'citizen' => 'WNI',
            'address' => 'Perumnas Sako Palembang',
            'telephone' => '087794084182',
            'univercity' => 'STMIK PALCOMTECH',
            'grade' => 'Strata 1 (S1)',
            'ipk' => '3.75',
            'graduation' => '2018',
          ]);
        }

        $user1 = User::findOrFail(1);
        $user2 = User::findOrFail(2);
        $user3 = User::findOrFail(3);

        for ($i=9; $i >= 1; $i--) {
          Tour::create([
              'user_id' => $user1->id,
              'title' => 'TOUR PAKET DOMESTIK KE '.$i,
              'slug' => str_slug('TOUR PAKET DOMESTIK KE '.$i, '-'),
              'category' => 'Domestik',
              'images' => '/photos/no-image.jpg',
              'post_status' => 'Publish',
              'duration' => '4 HARI 3 MALAM',
              'start_period' => '2017-11-11',
              'end_period' => '2018-04-11',
              'price' => rand(1000000,99999999),
              'itinerary' => $lor,
              'terms_conditions' => $lor,
            ]);

            Tour::create([
              'user_id' => $user2->id,
              'title' => 'TOUR PAKET INTERNASIONAL KE '.$i,
              'slug' => str_slug('TOUR PAKET INTERNASIONAL KE '.$i, '-'),
              'category' => 'Internasional',
              'images' => '/photos/no-image.jpg',
              'post_status' => 'Publish',
              'duration' => '4 HARI 3 MALAM',
              'start_period' => '2017-11-11',
              'end_period' => '2018-04-11',
              'price' => rand(1000000,99999999),
              'itinerary' => $lor,
              'terms_conditions' => $lor,
            ]);
        }

        for ($i=6; $i >= 1; $i--) {
          Umroh::create([
              'user_id' => $user1->id,
              'title' => 'TOUR PAKET UMROH EKONOMIS KE '.$i,
              'slug' => str_slug('TOUR PAKET UMROH EKONOMIS KE '.$i, '-'),
              'category' => 'Ekonomis',
              'images' => '/photos/no-image.jpg',
              'post_status' => 'Publish',
              'duration' => '13 HARI',
              'start_period' => '2017-11-11',
              'end_period' => '2018-04-11',
              'price' => rand(20000000,99999999),
              'itinerary' => $lor,
              'terms_conditions' => $lor,
            ]);

            Umroh::create([
              'user_id' => $user2->id,
              'title' => 'TOUR PAKET UMROH GOLD KE '.$i,
              'slug' => str_slug('TOUR PAKET UMROH GOLD KE '.$i, '-'),
              'category' => 'Gold',
              'images' => '/photos/no-image.jpg',
              'post_status' => 'Publish',
              'duration' => '13 HARI',
              'start_period' => '2017-11-11',
              'end_period' => '2018-04-11',
              'price' => rand(22500000,99999999),
              'itinerary' => $lor,
              'terms_conditions' => $lor,
            ]);

            Umroh::create([
              'user_id' => $user3->id,
              'title' => 'TOUR PAKET UMROH VIP KE '.$i,
              'slug' => str_slug('TOUR PAKET UMROH VIP KE '.$i, '-'),
              'category' => 'VIP',
              'images' => '/photos/no-image.jpg',
              'post_status' => 'Publish',
              'duration' => '13 HARI',
              'start_period' => '2017-11-11',
              'end_period' => '2018-04-11',
              'price' => rand(26500000,99999999),
              'itinerary' => $lor,
              'terms_conditions' => $lor,
            ]);
        }

        for ($i=1; $i <= 6; $i++) {
          Article::create([
              'user_id' => $user3->id,
              'title' => 'ARTIKEL PERJALANAN BERSAMA INSTANSI KE '.$i,
              'slug' => str_slug('ARTIKEL PERJALANAN BERSAMA INSTANSI KE '.$i, '-'),
              'post_status' => 'Publish',
              'images' => '/photos/no-image.jpg',
              'description' => $lor
            ]);
          Article::create([
            'user_id' => $user1->id,
            'title' => 'ARTIKEL TENTANG TRAVELING KE '.$i,
            'slug' => str_slug('ARTIKEL TENTANG TRAVELING KE '.$i, '-'),
            'post_status' => 'Publish',
            'images' => '/photos/no-image.jpg',
            'description' => $lor
          ]);
        }

        $slide = [
          [
            'slug' => 'tiket',
            'images' => '/photos/slideshow/CONTOH-SLIDESHOW.png',
            'post_status' => 'Publish',
          ],
          [
            'slug' => 'hotel',
            'images' => '/photos/slideshow/slideshow.jpg',
            'post_status' => 'Publish',
          ],
          [
            'slug' => 'tour',
            'images' => '/photos/slideshow/slideshow1.png',
            'post_status' => 'Publish',
          ],
          [
            'slug' => 'umroh',
            'images' => '/photos/slideshow/slideshow3.jpg',
            'post_status' => 'Publish',
          ],
          [
            'slug' => 'tour',
            'images' => '/photos/slideshow/slideshow4.jpg',
            'post_status' => 'Publish',
          ],
          [
            'slug' => 'umroh',
            'images' => '/photos/slideshow/slideshow.jpg',
            'post_status' => 'Publish',
          ],
        ];

        foreach ($slide as $k => $v) {
          Slideshows::create($v);
        }
    }
}
