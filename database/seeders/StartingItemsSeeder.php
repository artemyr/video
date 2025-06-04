<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Models\Slider;
use App\Models\Text;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StartingItemsSeeder extends Seeder
{
    public function run(): void
    {
//        foreach ($this->getSliderItems() as $item) {
//            Slider::query()->create($item);
//        }
//
//        foreach ($this->getPriceItems() as $item) {
//            Price::query()->create($item);
//        }

        foreach ($this->getTextItems() as $item) {
            Text::query()->create($item);
        }
    }

    private function getSliderItems(): array
    {
        $photosDir = resource_path('images/slider');
        $files = scandir($photosDir);
        $sliderPhotos = [];

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $filePath = $photosDir . DIRECTORY_SEPARATOR . $file;
            $uFile = new UploadedFile($filePath,$file);

            $sliderPhotos[] = Storage::disk('images')
                ->put('slider', $uFile);
        }

        return [
            [
                'title' => '1',
                'photo' => $sliderPhotos[0],
            ],
            [
                'title' => '2',
                'photo' => $sliderPhotos[1],
            ],
            [
                'title' => '3',
                'photo' => $sliderPhotos[2],
            ],
            [
                'title' => '4',
                'photo' => $sliderPhotos[3],
            ],
        ];
    }

    private function getPriceItems(): array
    {
        return [
            [
                'title' => '3.000 р/шт.',
                'description' => <<<END
<ul>
    <li>1 видеоролик</li>
    <li>длительность до 1 мин.</li>
    <li>свемка 1-1,5ч</li>
    <li>написание сценария при необходимости</li>
    <li>помощь в выборе референсов</li>
    <li>до 5 правок</li>
    <li>готовность до 3х дней (оговаривается индивидуально)</li>
</ul>
END
            ],
            [
                'title' => 'от 1.500р/шт.',
                'description' => <<<END
<ul>
    <li>от 10 видеороликов</li>
    <li>длительность до 1 мин.</li>
    <li>длительность съемки оговаривается индивидуально</li>
    <li>написание сценария при необходимости</li>
    <li>помощь в выборе референсов</li>
    <li>до 5 правок на каждый ролх|</li>
    <li>готовность от 5х дней (оговаривается индивидуально)</li>
</ul>
END
            ],
            [
                'title' => 'от 20.000р/мес.',
                'description' => <<<END
<ul>
    <li>Услуги SMM-менеджера (полное ведение)</li>
    <li>совместная работа над бифом для формулирования ценности и позицинирования бренда.</li>
    <li>поиск идей и создание креативных концепций для постов. Reels и Stories.</li>
    <li>написание текстов с учетом особенностей ЦА и целей постов (вовлечение, продажи и тд.)|</li>
    <li>регулярная публикация контента</li>
    <li>настройка визуальной концепции.</li>
    <li>органическое продвижение через эштеги,геоданные и тренды.</li>
    <li>регулярный мониторинг актуальных форматов, музыки и идей для контента.</li>
    <li>езаимодействие с аудиторией (ответа на сомментарии, проведение опросов, квизов</li>
    <li>других интерактивов в Stories)</li>
    <li>выезды на съемки контента (в пределах Краснодара)</li>
</ul>
END
            ],
        ];
    }

    private function getTextItems(): array
    {
        return [
            [
                'code' => 'main.about',
                'text' => <<<END
<p class="text-xl mb-[18px]">Приветствую</p>
<p class="my-[14px] font-sec">Меня зовут Дарья, я SMM-менеджер и мобильный видеограф из Краснодара.</p>
<p class="my-[14px]">
    Моя задача - сделать ваш бренд заметным и привлекательным в социальных сетях с помощью качественного видеоконтента и ведения страниц.
    Я создаю короткометражные ролики, которые не только красиво выглядят, но и помогают продавать ваш продукт, донести его ценность до аудитории и повысить узнаваемость.
</p>
<p class="my-[14px]">
    Видео - один из самых мощных инструментов современного маркетинга. Именно поэтому я предлагаю самые разнообразные форматы.
</p>
<p class="my-[14px]">
    Вместе мы разработаем визуальную концепцию, наполним вашу страницу
    оригинальным и качественным контентом, а также привлечём именно тех клиентов, которые действительно заинтересованы в вашем продукте.
</p>
END
            ]
        ];
    }
}
