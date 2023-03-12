<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\PostCategory;
use App\Entity\Teaser;
use App\Entity\TeaserCategory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $entityCategories = $manager->getRepository(PostCategory::class)->findAll();
        $entityTeaserCategories = $manager->getRepository(TeaserCategory::class)->findAll();

        $posts = [
            [
                'name' => 'Как живет 84-летняя вдова Владимира Высоцкого Марина Влади',
                'description' => 'Недавно французская актриса Марина Влади, в России больше известная как последняя жена Владимира Высоцкого, отметила день рождения – 10 мая ей исполнилось 84 года. Давайте узнаем, как она теперь поживает. Со знаменитым бардом ее уже мало что связывает. В конце 2015 года Влади продала часть его вещей, а также дом под Парижем, где они жили. Вдова объяснила тогда, что хочет порвать с прошлым. Кроме того, ей нужны были деньги, чтобы помочь сыну, попавшему в аварию. К тому же в силу возраста стало тяжеловато жить одной, поэтому она решила перебраться поближе к детям. Сейчас Марина поддерживает отношения только с сыновьями, их семьями и узким кругом самых близких друзей. В последние годы кров с ней делили домашние питомцы – собаки и канарейки, но, увы, в силу естественных причин никого из них уже нет в живых. За всю жизнь у Влади было 57 собак.',
                'file' => 'data/video.mp4',
            ],
            [
                'name' => 'Работница сети магазинов "Пятерочка" бросила работу после того, как за выходные заработала 416.067 рублей!',
                'description' => 'Недавно французская актриса Марина Влади, в России больше известная как последняя жена Владимира Высоцкого, отметила день рождения – 10 мая ей исполнилось 84 года. Давайте узнаем, как она теперь поживает. Со знаменитым бардом ее уже мало что связывает. В конце 2015 года Влади продала часть его вещей, а также дом под Парижем, где они жили. Вдова объяснила тогда, что хочет порвать с прошлым. Кроме того, ей нужны были деньги, чтобы помочь сыну, попавшему в аварию. К тому же в силу возраста стало тяжеловато жить одной, поэтому она решила перебраться поближе к детям. Сейчас Марина поддерживает отношения только с сыновьями, их семьями и узким кругом самых близких друзей. В последние годы кров с ней делили домашние питомцы – собаки и канарейки, но, увы, в силу естественных причин никого из них уже нет в живых. За всю жизнь у Влади было 57 собак.',
                'file' => 'data/video.mp4',
            ],
        ];

        $user = $manager->getRepository(User::class)->findAll();

        foreach ($posts as $post) {
            $manager->persist($this->makePost($post['name'], $post['description'], $entityCategories, $entityTeaserCategories, $post['file'], current($user)));
        }

        // Teasers

        $teasers = [
            [
                'name' => 'Чтобы заниматься сексом с молодой женой без виагры даже в 60 лет, нужно..',
                'url' => 'https://msk.barbos.ru/disto/?p=1252492809',
                'groupId' => 'campaignId',
                'blockIp' => [],
                'file' => 'data/image.jpg',
            ],
            [
                'name' => 'Как жила "бабушка" Брухунова до Петросяна: тяжелые дни',
                'url' => 'https://msk.barbos.ru/disto/?p=1252492809',
                'groupId' => 'campaignId1',
                'blockIp' => [],
                'file' => 'data/image.jpg',
            ],
        ];

        for ($i = 0; $i < 10; ++$i) {
            foreach ($teasers as $teaser) {
                $manager->persist(
                    $this->makeTeaser($teaser['name'], $teaser['url'], $teaser['file'], $entityTeaserCategories, $teaser['groupId'], $teaser['blockIp'])
                );
            }
        }

        $manager->flush();
    }

    private function makePostCategory(string $name, ObjectManager $manager): PostCategory
    {
        $entity = new PostCategory();
        $entity->setName($name);

        $manager->persist($entity);

        return $entity;
    }

    private function makeTeaserCategory(string $name, ObjectManager $manager): TeaserCategory
    {
        $entity = new TeaserCategory();
        $entity->setName($name);

        $manager->persist($entity);

        return $entity;
    }

    private function makePost(string $name, string $description, array $categories, array $teaserCategories, string|null $filePath = null, User|null $owner = null): Post
    {
        $entity = new Post();
        $entity->setName($name);
        $entity->setDescription($description);
        $entity->setOwner($owner);
        $entity->setFile($filePath);

        foreach ($categories as $category) {
            $entity->addPostCategory($category);
        }

        foreach ($teaserCategories as $teaserCategory) {
            $entity->addTeaserCategory($teaserCategory);
        }

        return $entity;
    }

    private function makeTeaser(string $name, string $url, string $filePath, array $teaserCategories, string $groupId, array $blockIp = []): Teaser
    {
        $entity = new Teaser();
        $entity->setName($name);
        $entity->setFile($filePath);
        $entity->setUrl($url);
        $entity->setBlockIp($blockIp);
        $entity->setGroupId($groupId);

        foreach ($teaserCategories as $teaserCategory) {
            $entity->addCategory($teaserCategory);
        }

        return $entity;
    }
}
