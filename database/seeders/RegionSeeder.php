<?php

namespace Database\Seeders;

use App\Models\GeneralRegion;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $region = [
            "قطاع شرقي" =>  [
                "ميس الجبل",
                "الطيبه",
                "مركبا",
                "حولا",
                "بليدا",
                "عديسة",
                "القنطرة",
                "طلوسة",
                "بني حيان",
                "دير سريان",
                "عدشيت",
                "محيبيب",
                "القصير",
                "علمان",
                "شبعا",
                "الهبارية",
                "كفرشوبا",
                "جديدة مرجعيون",
                "الخيام",
                "كفركلا",
                "ديرميماس",
                "برج الملوك",
                "القليعة",
                "البويضة",
                "رب ثلاثين",
                "دبين",
                "بلاط",
                "ابل السقي",
                "عين عرب",
                "العباسية الحدودية",
                "كوكبا",
                "الوزاني",
                "حاصبيا",
                "كفرحمام",
                "راشيا الفخار",
                "وادي الحجير"
            ],
            "قطاع اوسط" =>  [
                "بنت جبيل",
                "رميش",
                "عين ابل",
                "تبنين",
                "حاريص",
                "حداثا",
                "عيتا الجبل",
                "صربين",
                "رشاف",
                "برعشيت",
                "شقرا",
                "صفد البطيخ",
                "الجميجمة",
                "السلطانية",
                "خربة سلم",
                "ديرانطار",
                "كفردونين",
                "قلاوية",
                "برج قلاوية",
                "فرون",
                "ياطر",
                "كفرا",
                "الغندورية",
                "حانين",
                "عيناتا",
                "عيترون",
                "مارون الراس",
                "كونين",
                "بيت ياحون",
                "الطيري",
                "يارون" ,
                "جبل الباط"
            ],
            "قطاع غربي" =>  [
                "اللبونة" ,
                "عيتا الشعب",
                "راميه",
                "بيت ليف",
                "القوزح",
                "دبل",
                "شمع",
                "طيرحرفا",
                "البستان",
                "مروحين",
                "الجبين",
                "الحنية",
                "الزلوطية",
                "الظهيرة",
                "القليلة",
                "المنصوري",
                "ام التوت",
                "الناقورة",
                "شيحين",
                "علما الشعب",
                "مجدلزون",
                "يارين",
                "جبل بلاط",
                "وادي حسن",
                "وادي حامول"
            ],
            "صور" =>  [
                "صور",
                "البازورية",
                "برج الشمالي",
                "العباسية",
                "دير قانون راس العين",
                "معركة",
                "طورا",
                "بدياس",
                "باتوليه",
                "البرغلية",
                "القليلة",
                "النفاخية",
                "برج رحال",
                "جناتا",
                "دردغيا",
                "طير دبا",
                "طيرفلسيه",
                "عين بعال",
                "جويا",
                "الشهابية",
                "المجدل",
                "سلعا",
                "دير كيفا",
                "صريفا",
                "ارزون",
                "شحور",
                "الحلوسية",
                "معروب",
                "باريش",
                "دبعال",
                "بافليه",
                "محرونة",
                "يانوح",
                "قانا",
                "جبال البطم",
                "حناويه",
                "زبقين",
                "رشكانية",
                " دير عامص ",
                "مزرعة مشرف",
                "رمادية",
                "صديقين",
                "الشعيتية",
                "البياض",
                "مالكية",
                "عيتيت",
                "الكنيسة"
            ],
            "الزهراني" =>  [
                "ارزي",
                "بابلية",
                "بيسارية",
                "حجة",
                "خرايب",
                "زرارية",
                "سكسكية",
                "صرفند",
                "غسانية",
                "مروانية",
                "نجارية",
                "انصارية",
                "تفاحتا",
                "خرطوم",
                "عدلون",
                "قعقعية الصنوبر",
                "كوثرية السياد",
                "لوبية",
                "عدوسية"
            ],
            "اقليم التفاح" =>  [
                "الريحان",
                "زحلتي",
                "سجد",
                "سنيا",
                "صباح",
                "صفاريه",
                "صيدون",
                "وادي جزين",
                "عاراي",
                "عازور",
                "عرمتى",
                "العيشية",
                "عين المير",
                "قطيم وحيداب",
                "قيتولة",
                "كرخا",
                "كفرجرة",
                "كفرحونة",
                "كفرفالوس",
                "اللويزة",
                "لبعا",
                "المجيدل",
                "مشموشة",
                "المكنونية",
                "مليخ",
                "جباع",
                "عين قانا",
                "عين بوسوار",
                "كفرفيلا",
                "جرجوع",
                "عربصاليم",
                "حومين الفوقا",
                "رومين",
                "صربا",
                "عزة",
                "حومين التحتا",
                "الميدان"
            ],
            "صيدا" =>  [
                "صيدا",
                "اركي",
                "برامية",
                "برتي",
                "بقسطا",
                "بنعقول",
                "حارة صيدا",
                "درب السيم",
                "زيتا",
                "الصالحية",
                "طنبوريت",
                "عبشرا",
                "عقتانيت",
                "عنقون",
                "عين الدلب",
                "الغازية",
                "القرية",
                "قناريت",
                "كفربيت",
                "كفرحتى",
                "كفرملكي",
                "مجدليون",
                "عبر طبايا",
                "المعمرية",
                "مغدوشة",
                "المية ومية",
                "الهلالية"
            ],
            "النبطية" =>  [
                "النبطية",
                "النبطية التحتا",
                "النبطية الفوقا",
                "ارنون",
                "الدوير",
                "الشرقية",
                "القصيبة",
                "الكفور",
                "النميرية",
                "انصار",
                "بريقع",
                "تول",
                "جبشيت",
                "حاروف",
                "حبوش",
                "دير الزهراني",
                "زبدين",
                "زفتا",
                "زوطر الشرقية",
                "زوطر الغربية",
                "سيني",
                "شوكين",
                "صير الغربية",
                "عبا",
                "قاقعية الجسر",
                "كفرتبنيت",
                "كفررمان",
                "كفرصير",
                "كفروة",
                "ميفدون",
                "يحمر"
            ],
            "الضاحية الجنوبية" =>  [
                "برج البراجنة",
                "المريجة",
                "الليلكي",
                "الغدير",
                "الأوزاعي",
                "الجناح",
                "الرمل العالي",
                "الرويس",
                "الصفير",
                "الغبيري",
                "المشرفية",
                "المعمورة",
                "بئر العبد",
                "بئر حسن",
                "حارة حريك",
                "حي ماضي",
                "شاتيلا"
            ],
            "بعلبك" =>  [
                "بعلبك",
                "ايعات",
                "حام",
                "الحلانية",
                "حورتعلا",
                "حوش تل صفية",
                "حوش النبي",
                "حوش الدهب",
                "حوش بردى",
                "دورس",
                "السفري",
                "شعت",
                "الصوانية",
                "طفيل",
                "طليا",
                "الطيبة",
                "عين بورضاي",
                "القاع",
                "مجدلون",
                "معربون",
                "مقنة",
                "النبي سباط",
                "نحلة",
                "وادي الصفا",
                "وادي المشمشة",
                "يونين",
                "الأنصار",
                "النبي شيت",
                "الخضر",
                "جنتا",
                "الخريبة",
                "يحفوفا",
                "سرعين الفوقا",
                "سرعين التحتا",
                "بريتال",
                "طليا",
                "جديدة الفاكهة",
                "رسم الحدث",
                "طبشار"
            ],
            "الهرمل" =>  [
                "الهرمل",
                "القصر",
                "الشواغير",
                "جوار الحشيش",
                "فيسان",
                "وادي الكرم",
                "وادي النيرة",
                "وادي العس",
                "وادي بنيت",
                "وادي الرطل",
                "وادي التركمان",
                "مراح العين",
                "القرينة",
                "البستان",
                "الحريقة",
                "الحميري",
                "الخرايب",
                "زغرين",
                "الزويتيني",
                "السويسة",
                "الشربين",
                "بريحا",
                "قنافذ",
                "المعاصر",
                "المعيصرة",
                "حوش السيد علي",
                "سهلات الماء",
                "مزرعة سجد",
                "مزرعة الفقيه",
                "مزرعة الطشم",
                "المنصورة",
                "شربين الفوقا"
            ],
            "شمسطار" =>  [
                "شمسطار",
                "تمنين التحتا",
                "تمنين الفوقا",
                "قصرنبا",
                "بدنايل",
                "بيت شاما",
                "العقيدية",
                "كفردبش",
                "حوش الرافقة",
                "حوش منيد",
                "بيت صليبي",
                "طاريا",
                "النبي رشادة",
                "التليلة",
                "حدث بعلبك",
                "مصنع الزهرة",
                "كفردان",
                "جبعا",
                "عين السوداء",
                "قلد السبع",
                "رماسا",
                "مزرعة التوت",
                "وادي الأحمر",
                "مزرعة بيت سويدان",
                "مزرعة الضليل",
                "وادي ام علي",
                "سيدة حنا",
                "حوش مصراية",
                "حوش العرب",
                "الشحيمية",
                "اللبوة",
                "حلبتا",
                "الصوبا",
                "العين",
                "وادي فعرا",
                "الفاكهة",
                "النبي عثمان",
                "النقرة",
                "الحرفوش",
                "حربتا",
                "زبود",
                "عرسال",
                "مقراق",
                "الجديدة",
                "رأس بعلبك",
                "جبولة",
                "التوفيقية",
                "قليلة",
                "الجوبانية"
            ],
            "الحدود اللبنانية السورية" =>
            [
                "الحدود اللبنانية السورية"
            ]
        ];
        foreach ($region as $generalRegion => $regionList) {

            $generalRegionId = DB::table('general_regions')
                ->where('general_regions', $generalRegion)
                ->value('id');

            foreach ($regionList as $region) {
                DB::table('regions')->insert([
                    'regions' => $region,
                    'general_region_id' => $generalRegionId,
                    'created_at' => now(),
                ]);
            }
        }
    }
}
