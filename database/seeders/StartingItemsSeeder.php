<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Text;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StartingItemsSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->getSliderItems() as $item) {
            Slider::query()->create($item);
        }

        foreach ($this->getPriceItems() as $item) {
            Price::query()->create($item);
        }

        foreach ($this->getTextItems() as $item) {
            Text::query()->create($item);
        }

        foreach ($this->getReviewItems() as $item) {
            Review::query()->create($item);
        }

        foreach ($this->getSettingsItems() as $item) {
            Setting::query()->create($item);
        }
    }

    private function getSliderItems(): array
    {
        $sliderPhotos = $this->importImages('images/slider','slider');

        return [
            [
                'title' => '1',
                'image' => $sliderPhotos[0],
            ],
            [
                'title' => '2',
                'image' => $sliderPhotos[1],
            ],
            [
                'title' => '3',
                'image' => $sliderPhotos[2],
            ],
            [
                'title' => '4',
                'image' => $sliderPhotos[3],
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
                'code' => TextsEnum::MAIN_ABOUT->value,
                'description' => 'Текст на главной странице',
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
            ],
            [
                'code' => TextsEnum::MAIN_FOOTER_TEXT->value,
                'description' => 'Текст в подвале',
                'text' => <<<END
Мобильная видеосъемка и услуги SMМ-Дарья.<br>г. Краснодар<br>
END
            ],
            [
                'code' => TextsEnum::PRICES_BOTTOM_TEXT->value,
                'description' => 'Текст после цен на странице стоимость',
                'text' => <<<END
<p class="text-center text-brown text-md font-bold">ВАЖНАЯ ИНФОРМАЦИЯ:</p>
<p class="text-center text-brown text-sm mb-10">ПРОЧИТАЙТЕ ИНФОРМАЦИЮ ПЕРЕД БРОНИРОВАНИЕМ</p>

<ul>
    <li class="">Для брони напишите мне WhatsApp или Telegram</li>
    <li>Запись и бронирование осуществляется внесением задатка 50%,</li>
    <li>замена основной аудиодорожки при монтаже видеоролика НЕ считается правкой (согласовывается только ПЕРЕД монажем)</li>
    <li>Остаток оплачивается в день съемхи.</li>
    <li>первичные видеоматериалы (исходники) не пердоставляются.</li>
</ul>
END
            ],
        ];
    }

    private function getReviewItems(): array
    {
        $reviewsImages = $this->importImages('images/reviews','reviews');

        return [
            [
                'title' => 'CYBERNET',
                'description' => <<<END
Работаем с Дарьей давно, заказывали уже более 10 роликов. Комфортно работать, радует качество видео, быстрая готовность и комфортная стоимость.
END,
                'image' => $reviewsImages[0]
            ],
            [
                'title' => 'CYBERNET',
                'description' => <<<END
Работаем с Дарьей давно, заказывали уже более 10 роликов. Комфортно работать, радует качество видео, быстрая готовность и комфортная стоимость.
END,
                'image' => $reviewsImages[1]
            ],
            [
                'title' => 'CYBERNET',
                'description' => <<<END
Работаем с Дарьей давно, заказывали уже более 10 роликов. Комфортно работать, радует качество видео, быстрая готовность и комфортная стоимость.
END,
                'image' => $reviewsImages[2]
            ],
            [
                'title' => 'CYBERNET',
                'description' => <<<END
Работаем с Дарьей давно, заказывали уже более 10 роликов. Комфортно работать, радует качество видео, быстрая готовность и комфортная стоимость.
END,
                'image' => $reviewsImages[3]
            ],
            [
                'title' => 'CYBERNET',
                'description' => <<<END
Работаем с Дарьей давно, заказывали уже более 10 роликов. Комфортно работать, радует качество видео, быстрая готовность и комфортная стоимость.
END,
                'image' => $reviewsImages[4]
            ],
            [
                'title' => 'CYBERNET',
                'description' => <<<END
Работаем с Дарьей давно, заказывали уже более 10 роликов. Комфортно работать, радует качество видео, быстрая готовность и комфортная стоимость.
END,
                'image' => $reviewsImages[5]
            ],
        ];
    }

    private function getSettingsItems(): array
    {
        return [
            [
                'code' => SettingsEnum::MAIN_PHONE->value,
                'value' => '8-958-546-97-91',
                'description' => 'Номер телефона'
            ],
            [
                'code' => SettingsEnum::MAIN_TG->value,
                'value' => 'GK_Darya_13',
                'description' => 'Telegram nickname'
            ],
            [
                'code' => SettingsEnum::CONTACT_TEXT_1->value,
                'value' => 'Фотограф',
                'description' => 'Подпись картинки в контактах'
            ],
            [
                'code' => 'title.home',
                'value' => 'Главная',
                'description' => 'title главной страницы'
            ],
            [
                'code' => 'description.home',
                'value' => 'Главная',
                'description' => 'Description главной страницы'
            ],
            [
                'code' => 'title.contacts.page',
                'value' => 'Контакты',
                'description' => 'title на странице контакты'
            ],
            [
                'code' => 'description.contacts.page',
                'value' => 'Контакты',
                'description' => 'Description на странице контакты'
            ],
            [
                'code' => 'title.reviews.page',
                'value' => 'Отзывы',
                'description' => 'title на странице отзывы'
            ],
            [
                'code' => 'description.reviews.page',
                'value' => 'Отзывы',
                'description' => 'Description на странице отзывы'
            ],
            [
                'code' => 'title.price.page',
                'value' => 'Стоимость',
                'description' => 'title на странице стоимость'
            ],
            [
                'code' => 'description.price.page',
                'value' => 'Стоимость',
                'description' => 'Description на странице стоимость'
            ],
            [
                'code' => 'title.portfolio.page',
                'value' => 'Портфолио',
                'description' => 'title на странице портфолио'
            ],
            [
                'code' => 'description.portfolio.page',
                'value' => 'Портфолио',
                'description' => 'Description на странице портфолио'
            ],
        ];
    }

    private function importImages(string $sourceDir, string $destDir): array
    {
        $photosDir = resource_path($sourceDir);
        $files = scandir($photosDir);
        $sliderPhotos = [];

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $filePath = $photosDir . DIRECTORY_SEPARATOR . $file;
            $uFile = new UploadedFile($filePath,$file);

            $sliderPhotos[] = Storage::disk('images')
                ->put($destDir, $uFile);
        }
        return $sliderPhotos;
    }
}
