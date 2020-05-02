<?php

namespace App\DataFixtures;

//use Cocur\Slugify\Slugify;
use App\Entity\Ad;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        //$slugify = new Slugify();

        for ($i = 1; $i <= 30; $i++) {
            $ad = new Ad();

            $title = $faker->sentence();
            //$slug = $slugify->slugify($title);
            // Lorempixel down pour le moment
            //$coverImage = $faker->imageUrl(1000, 350);
            $introduction = $faker->paragraph(2);
            $content = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';

            $ad->setTitle($title)
                //->setSlug($slug)
                //->setCoverImage($coverImage)
                ->setCoverImage('https://picsum.photos/1000/350?random'. mt_rand(1, 999))
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(1, 5));

                for($j =1; $j <= mt_rand(2,5); $j++) {
                    $image = new Image();

                    $image->setUrl('https://picsum.photos/640/480?random'. mt_rand(1, 999))
                        ->setCaption($faker->sentence())
                        ->setAd($ad);

                    $manager->persist($image);
                }

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
