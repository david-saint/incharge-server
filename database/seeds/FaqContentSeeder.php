<?php

use App\Models\FaqGroup;
use Illuminate\Database\Seeder;

class FaqContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FaqGroup::find(1)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => '5 Basic Steps of Using a Female Condom',
                    'content' => array(
                        0 => [
                            'title' => 'Use A New Female Condom For Each Sex Act',
                            'values' => [
                                'Check the condom package. Do not use if it’s torn or damaged. Avoid using a condom past the expiration date - do so only if newer condoms aren’t available.',
                                'If possible, wash your hands with mild soap and clean water before inserting the condom.',
                            ],
                        ],
                        1 => [
                            'title' => 'Before Any Physical Contact, Insert The Condom Into The Vagina.',
                            'values' => [
                                'Can be inserted up to 8 hours before sex. For the most protection, insert the condom before the penis comes in contact with the vagina.',
                                'Choose a position that is comfortable for insertion:- squat, raise one leg, sit or lie down',
                                'Rub the sides of the female condom together to spread the lubricant evenly.',
                                'Grasp the ring at the closed end, and squeeze it, so it becomes long and narrow.',
                                'With the other hand, separate the outer lips (labia) and locate the opening of the vagina.',
                                'Gently push the inner ring into the vagina as far up as it will go. Insert a finger into the condom to push it into place. About 2 to 3 centimetres of the condom and the outer ring remain outside the vagina.',
                            ],
                        ],
                        2 => [
                            'title' => 'Ensure that the penis enters the condom and stays inside the condom',
                            'values' => [
                                'The man or woman should carefully guide the tip of his penis inside the condom - not between the condom and the wall of the vagina. If his penis goes outside the condom, withdraw and try again.',
                                'If the condom is accidentally pulled out of the vagina or pushed into it during sex, put the condom back in place.',
                            ],
                        ],
                        3 => [
                            'title' => 'After the man withdraws his penis, hold the outer ring of the condom, twist to seal in fluids, and gently pull it out of the vagina.',
                            'values' => [
                                'The female condom does not need to be removed immediately after sex.',
                                'Remove the condom before standing up, to avoid spilling semen.',
                                'If the couple has sex again, they should use a new condom.',
                                'Reuse of female condoms is not recommended.',
                            ],
                        ],
                        4 => [
                            'title' => 'Dispose of the used condom safely',
                            'values' => [
                                'Wrap the condom in its package and put it in the trash. Do not put the condom into a flush toilet, as it can cause problems with plumbing.',
                            ],
                        ],
                    ),
                ],
                1 => [
                    'title' => 'Questions and Answers about Female Condoms',
                    'content' => array(
                        0 => [
                            'title' => 'Is the female condom difficult to use?',
                            'values' => [
                                'No, but it does require practice and patience.',
                            ],
                        ],
                        1 => [
                            'title' => 'Can female condoms effectively prevent both pregnancy and STIs, including HIV?',
                            'values' => [
                                'Yes, Female condoms offer dual protection, against both pregnancy and STIs, including HIV, if used consistently and correctly. Many people however, do not use condoms every time they have sex, or do not use them correctly. This reduces protection from both pregnancy and STIs.',
                            ],
                        ],
                        2 => [
                            'title' => 'Can a female condom and a male condom be used at the same time?',
                            'values' => [
                                'No, Male and female condoms should not be used together. This can cause friction that may lead to slipping or tearing of the condoms.',
                            ],
                        ],
                        3 => [
                            'title' => 'What is the best way to make sure the penis goes into the condom and not outside the condom?',
                            'values' => [
                                'To avoid incorrect use, the man should carefully guide his penis and place the tip inside the outer ring of the condom. If the penis goes between the wall of the vagina and the condom, the man should withdraw and try again.',
                            ],
                        ],
                        4 => [
                            'title' => 'Can the female condom be used more than once?',
                            'values' => [
                                'Reuse of the female condom is not recommended. Reuse of currently available female condoms has not been tested.',
                            ],
                        ],
                        5 => [
                            'title' => 'Can the female condom be used while a woman is having her monthly bleeding?',
                            'values' => [
                                'Women can use the female condom during their monthly bleeding. The female condom cannot be used at the same time as a tampon, however. The tampon must be removed before inserting a female condom.',
                            ],
                        ],
                        6 => [
                            'title' => 'Isn’t the female condom too big to be comfortable?',
                            'values' => [
                                'No. Female condoms are the same length as male condoms, but wider. They are very flexible and fit to the shape of the vagina. Female condoms have been carefully designed and tested to fit any woman, whatever the size of her vagina, and any man, whatever the size of his penis.',
                            ],
                        ],
                        7 => [
                            'title' => 'Can a female condom get lost inside a woman’s body?',
                            'values' => [
                                'No. The female condom remains in a woman’s vagina until she takes it out. It cannot go past a woman’s cervix and into the womb (uterus) because it is too large for that.',
                            ],
                        ],
                        8 => [
                            'title' => 'Can the female condom be used in different sexual positions?',
                            'values' => [
                                'Yes. The female condom can be used in any sexual position.',
                            ],
                        ],
                    ),
                ],
            ))
        ]);

        FaqGroup::find(2)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => 'Questions and Answers About Combined Oral Contraceptives',
                    'content' => array(
                        0 => [
                            'title' => 'Should a woman take a ‘rest’ from COCs after taking them for a time?',
                            'values' => [
                                'No. There is no evidence that taking a ‘rest’ is helpful. In fact, taking a ‘rest’ from COCs can lead to unintended pregnancy. COCs can safely be used for many years without having to stop taking them periodically.',
                            ],
                        ],
                        1 => [
                            'title' => 'If a woman has been taking COCs for a long time, will she still be protected from pregnancy after she stops taking COCs?',
                            'values' => [
                                'No. A woman is protected only as long as she takes her pills regularaly.',
                            ],
                        ],
                        2 => [
                            'title' => 'How long does it take to become pregnant after stopping COCs?',
                            'values' => [
                                'Women who stop using COCs can become pregnant as quickly as women who stop non-hormonal methods. COCs do not delay the return of a woman’s fertility after she stops taking them. The bleeding pattern a woman had before she used COCs generally return after she stops taking them. Some women may have to wait a few months before their usual bleeding pattern returns.',
                            ],
                        ],
                        3 => [
                            'title' => 'Do COCs cause abortion?',
                            'values' => [
                                'No. Research onCOCs find that they do not disrupt an existing pregnancy. They should not be used to try to cause an abortion. They will not do so.',
                            ],
                        ],
                        4 => [
                            'title' => 'Do COCs cause birth defects? Will the fetus be harmed if a woman accidentally takes COCs while she is pregnant?',
                            'values' => [
                                'No. Good evidence shows that COCs will not cause birth defects and will not otherwise harm the fetus if a woman becomes pregnant while taking COCx or accidentally starts to take COCs when she is already pregnant.',
                            ],
                        ],
                        5 => [
                            'title' => 'Do COCs cause women to gain or lose a lot of weight?',
                            'values' => [
                                'No. Most women do not gain or lose weight due to COCs. Weight changes naturally as life circumstances change and as people age. Because these changes in weight are so common, many women think that COCs cause these gains or losses in weight. Studies find, however, that, on average, COCs do not affect weight. A few women experience sudden changes in weight when using COCs. These changes reverse after they stop taking COCs. It is not known why these women respond to COCs in this way.',
                            ],
                        ],
                        6 => [
                            'title' => 'Do COCs change women’s mood or sex drive?',
                            'values' => [
                                'Generally, no. Some women using COCs report these complaints. The great majority of COC users do not report any such changes, however, and some report that both mood and sex drive improve. It is difficult to tell whether such changes are due to the COCs or to other reasons. Providers can help a client with these problems. There is no evidence that COCs affect women’s sexual behaviour.',
                            ],
                        ],
                        7 => [
                            'title' => 'What can a provider say to a client asking about COCs and breast cancer?',
                            'values' => [
                                'The provider can point out that both COC users and women who do not use COCs can have breast cancer. In scientific studies breast cancer was slightly more common among women using COCs and those who had used COCs in the past 10 years than among other women. Scientists do not know whether or not COCs actually caused the slight increase in breast cancers. It is possible that the cancers were already there before COC use but were found sooner in COC users.',
                            ],
                        ],
                        8 => [
                            'title' => 'Can COCs be used as a pregnancy test?',
                            'values' => [
                                'No. A woman may experience some vaginal bleeding as a result of taking several COCs or one full cycle of COCs, but studies suggest that this practice does not accurately identify who is or is not pregnant. Thus, giving a woman COCs to see if she has bleeding later is not recommended as a way to tell if she is pregnant. COCs should not be given to women as a pregnancy test of sorts because they do not produce accurate results.'
                            ],
                        ],
                        9 => [
                            'title' => 'Must a woman have a pelvic examination before she can start COCs or at follow-up visits?',
                            'values' => [
                                'No. Instead, asking the right questions usually can help to make reasonably certain that a woman is not pregnant. No condition that could be detected by a pelvic examination rules out COC use.'
                            ],
                        ],
                        10 => [
                            'title' => 'Can women with varicose veins use COCs?',
                            'values' => [
                                'Yes. COCs are safe for women with varicose veins. Varicose veins are enlarged blood vessels close to the surface of the skin. They are not dangerous. They are not blood clots, nor are these veins the deep veins in the legs where a blood clot can be dangerous. A woman who has or has had deep vein thrombosis should not use COCs.'
                            ],
                        ],
                        11 => [
                            'title' => 'Can a woman safely take COCs throughout her life?',
                            'values' => [
                                'Yes. There is no minimum or maximum age for COC use. COCs can be an appropriate method for most women from onset of monthly bleeding to menopause.'
                            ],
                        ],
                        12 => [
                            'title' => 'Can women who smoke use COCs safely?',
                            'values' => [
                                'Women younger than age 35 who smoke can use low-dose COCs. Women age 35 and older who smoke should choose a method without estrogen or, if they smoke fewer than 15 cigarettes a day, monthly injectables. Older women who smoke can take the progestin-only pill if they prefer pills. All women who smoke should be urged to stop-smoking.'
                            ],
                        ],
                        13 => [
                            'title' => 'What if a client wants to use COCs but it is not reasonably certain that she is not pregnant after using the pregnancy checklist?',
                            'values' => [
                                'If pregnancy tests are not available, a woman can be given COCs to take home with instructions to begin their use within 5 days after the start of next monthly bleeding. She should use a backup method until then.'
                            ],
                        ],
                        14 => [
                            'title' => 'Can COCs be used as emergency contraceptive pills after unprotected sex?',
                            'values' => [
                                'Yes. As soon as possible, but no more than 5 days after unprotected sex, a woman can take COCs as ECPs. Progestin-only pills, however, are more effective and cause fewer side effects such as nausea and stomach upset.'
                            ],
                        ],
                        15 => [
                            'title' => 'What are the differences among monophasic, biphasic and triphasic pills?',
                            'values' => [
                                'Monophasic pills provide the same amount of estrogen and progestin in every hormonal pill. Biphasic and triphasic pills change the amount of estrogen and progestin at differ3ent points of the pill -taking cycle. For biphasic pills, the first 10 pills have one dosage, and then the next 11 pills have another level of estrogen and progestin. For triphasic pills, the first 7 or so pills have one dosage, the next 7 pills have another dosage, and the last 7 hormonal pills have yet another dosage. All prevent pregnancy in the same way. Differences in the side effects, effectiveness, and continuation appear to be slight.'
                            ],
                        ],
                        16 => [
                            'title' => 'Is it important for awoman to take her COCs at the same time each day?',
                            'values' => [
                                'Yes, for 2 reasons. Some side effects may be reduced by taking the pills at the same time each day. Also, taking a pill at same time each day can help women remember to take their pills more consistently. Linking pill taking with a daily activity also helps women remember to take their pills.',
                            ],
                        ],
                    ),
                ],
            ))
        ]);

        FaqGroup::find(3)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => '5 Basic Steps of Using a Diaphragm',
                    'content' => array(
                        0 => [
                            'title' => 'Squeeze a spoonful of spermicidal cream, jelly, or foam into the diaphragm and around the rim',
                            'values' => [
                                'Wash hands with mild soap and clean water, if possible.',
                                'Check the diaphragm for holes, cracks or tears by holding it up to the light.',
                                'Check the expirations date of the spermicide and avoid using any beyond its expiration date.',
                                'Insert the diaphragm less than 6 hours before having sex.',
                            ],
                        ],
                        1 => [
                            'title' => 'Press the rim together; push into the vagina as far as it goes',
                            'values' => [
                                'Choose a position that is comfortable for insertion:- squatting, raising one leg, sitting, or lying down.',
                            ],
                        ],
                        2 => [
                            'title' => 'Feel diaphragm to make sure it covers the cervix',
                            'values' => [
                                'Through the dome of the diaphragm, the cervix feels like the tip of the nose',
                                'If the diaphragm feels uncomfortable, take it out and insert it again.',
                            ],
                        ],
                        3 => [
                            'title' => 'Keep in place for at least 6 hours after sex',
                            'values' => [
                                'Keep the diaphragm in place at least 6 hours after having sex but no longer than 24 hours.',
                                'Leaving the diaphragm in place for more than one day may increase the risk of toxic shock syndrome. It can also cause a bad odour and vaginal discharge. (Odour and discharge go away on their own after the diaphragm is removed).',
                                'For multiple acts of sex, make sure that the diaphragm is in the correct position and also insert additional spermicide in front of the diaphragm before each act of sex.',
                            ],
                        ],
                        4 => [
                            'title' => 'To remove, slide a finger under the rim of the diaphragm to pull it down and out',
                            'values' => [
                                'Wash hands with mild soap and clean water, if possible.',
                                'Insert a finger into the vagina until the rim of the diaphragm is felt.',
                                'Gently slide a finger under the rim and pull the diaphragm down and out. Use care not to tear the diaphragm with fingernail.',
                                'Wash the diaphragm with mild soap and clean water and dry it after each use.',
                            ],
                        ],
                    ),
                ],
                1 => [
                    'title' => 'Questions and Answers About Spermicides and Diaphragms',
                    'content' => array(
                        0 => [
                            'title' => 'Do spermicides cause birth defects? Will the fetus be harmed if a woman accidentally uses spermicide while she is pregnant?',
                            'values' => [
                                'No. Good evidence shows that spermicides will not cause birth defects or otherwise harm the fetus if a woman becomes pregnant while using spermicides or accidentally uses spermicides when she is already pregnant.',
                            ],
                        ],
                        1 => [
                            'title' => 'Do spermicides cause cancer?',
                            'values' => [
                                'No. Spermicides do not cause cancer.',
                            ],
                        ],
                        2 => [
                            'title' => 'Do spermicides increase the risk of becoming infected with HIV?',
                            'values' => [
                                'Women who use nonoxynol-9 several times a day may face an increased risk of becoming infected with HIV. Spermicides can cause vaginal irritation, which may cause small lesions to form on the lining of the vagina or on the external genitals. These lesions may make it easier for a woman to become infected with HIV. Studies that suggest spermicide use increases HIV risk have involved women who used spermicides several times a day. Women who have multiple daily acts of sex should use another contraceptive method. A study among women using nonoxynol-9 an average of 3 times a week, however, found no increased risk of HIV infection for spermicide users compared with women not using spermicides. New spermicides that are less irritating may become available.',
                            ],
                        ],
                        3 => [
                            'title' => 'Is the diaphragm uncomfortable for the woman?',
                            'values' => [
                                'No, not if it is fitted and inserted correctly. The woman and her partner usually cannot feel the diaphragm during sex. The provider selects the properly sized diaphragm for each woman so that it fits her and does not hurt. If it is uncomfortable, she should come back to have the fit checked and to make sure that she is inserting and removing the diaphragm properly.',
                            ],
                        ],
                        4 => [
                            'title' => 'If a woman uses the diaphragm without spermicides, will it still prevent pregnancy?',
                            'values' => [
                                'There is not enough evidence to be certain. A few studies find that diaphragm users have higher pregnancy rates when they do not use a spermicide with it. Thus, using a diaphragm without spermicide is not recommended.',
                            ],
                        ],
                        5 => [
                            'title' => 'Could a woman leave a diaphragm in all day?',
                            'values' => [
                                'Yes, although doing so is usually not recommended. A woman could leave a diaphragm in all day if she cannot put it in shortly before having sex. She should not leave the diaphragm in for more than 24 hours, however. This can increase the risk of toxic shock syndrome.',
                            ],
                        ],
                        6 => [
                            'title' => 'Can a woman use lubricants with a diaphragm?',
                            'values' => [
                                'Yes, but only water- or silicone-based lubricants if the diaphragm is made of lates. Products made with oil cannot be used as lubricants because they damage latex. Materials that should not be used with latex diaphragms include any oils (cooking, baby, coconut, mineral), petroleum jelly, lotions, cold creams, butter, cocoa butter, and margarine. Oil-based lubricants will not harm a plastic diaphragm. Spermicides usually provide enough lubrication for diaphragm users.',
                            ],
                        ],
                        7 => [
                            'title' => 'Do diaphragms help protect women from STIs, including HIV?',
                            'values' => [
                                'Research suggests that the diaphragm may help protect somewhat against infections of the cervix such as gonorrhoea and chlamydia. Some studies have also found that it also may help protect against pelvic inflammatory disease and trichomoniasis. Studies are underway to assess protection from HIV. Currently, only male and female condoms are recommended for protection from HIV and other STIs.',
                            ],
                        ],
                        8 => [
                            'title' => 'What is the vaginal sponge, and how effective is it?',
                            'values' => [
                                'The vaginal sponge is made of plastic and contains spermicides. It is moistened with water and inserted into the vagina so that it rests against the cervix. Each sponge can be used only once. It is not widely available.',
                            ],
                        ],
                    ),
                ],
            ))
        ]);

        FaqGroup::find(4)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => 'Questions and Answers About Emergency Contraceptive Pills',
                    'content' => array(
                        0 => [
                            'title' => 'Do ECPs disrupt an existing pregnancy?',
                            'values' => [
                                'No. ECPs do not work if a woman is already pregnant. When taken before a woman has ovulated, ECPs prevent the release of an egg from the ovary or delay its release by 5 to 7 days. By then any sperm in the woman’s reproductive tract will have died, since sperm can survive there for only about 5 days.',
                            ],
                        ],
                        1 => [
                            'title' => 'Do ECPs cause birth defects? Will the fetus beharmed if a woman accidentally takes ECPs while she is pregnant?',
                            'values' => [
                                'No. Good evidence shows that ECPs will not cause birth defects and will not otherwise harm the fetus if a woman is already pregnant when she takes ECPs or if ECPs fail to prevent pregnancy.',
                            ],
                        ],
                        2 => [
                            'title' => 'How long do ECPs protect a woman from pregnancy?',
                            'values' => [
                                'Women who take ECPs should understand that they could become pregnant the next time they have sex unless they begin to use another method of contraception at once. Because ECPs delay ovulation in some women, she may be most fertile soon after taking ECPs. If she wants ongoing protection from pregnancy, she must start using another contraceptive method at once.',
                            ],
                        ],
                        3 => [
                            'title' => 'What oral contraceptive pills can be used as ECPs?',
                            'values' => [
                                'Many combined (estrogen-progestin) oral contraceptives and progestin-only pills can be used as ECPs. Any pills containing the hormones used for emergency contraception - levonorgestrel, norgestrel, norethindrone, and these progestins together with estrogen - can be used.',
                            ],
                        ],
                        4 => [
                            'title' => 'Is it safe to take 40 or 50 progestin-only pills as ECPs?',
                            'values' => [
                                'Yes. Progestin-only pills contain very small amounts of hormone. Thus, it is necessary to take many pills in order to receive the total ECP dose needed. In contrast, the ECP dosage with combined oral contraceptives is generally only 2 to 5 pills in each of 2 doses 12 hours apart. Women should not take 40 or 50 combined oral contraceptive pills as ECPs.',
                            ],
                        ],
                        5 => [
                            'title' => 'Are ECPs safe for women with HIV or AIDS! Can women on antirectoviral therapy safely use ECPs?',
                            'values' => [
                                'Yes. Women with HIV, AIDS, and those on antirectoviral therapy can safely use ECPs.',
                            ],
                        ],
                        6 => [
                            'title' => 'Are ECPs safe for adolescents?',
                            'values' => [
                                'Yes. A study of ECP use among girls 13 to 16 years old found it safe. Furthermore, all of the study participants were able to use ECPs correctly.',
                            ],
                        ],
                        7 => [
                            'title' => 'Can a woman who cannot use combined (estrogen-progestin) oral contraceptives or progestin-only pills as an ongoing method still safely use ECPs?',
                            'values' => [
                                'Yes. This is because ECP treatment is very brief.',
                            ],
                        ],
                        8 => [
                            'title' => 'If ECPs failed to prevent pregnancy, does a woman have a greater chance of that pregnancy being an ectopic pregnancy?',
                            'values' => [
                                'No. To date, no evidence suggests that ECPs increase the risk of ectopic pregnancy. Worldwide studies of progestin-only ECPs, including a United State Food and Drug administration review, have not found higher rates of ectopic pregnancy after ECPs failed than are found among pregnancies generally.',
                            ],
                        ],
                        9 => [
                            'title' => 'Why give women ECPs before they need them? Won’t that discourage or otherwise affect contraceptive use?',
                            'values' => [
                                'No Studies of women given ECPs in advance report these findings: 1. Women who have ECPs on hand took them sooner after having unprotected sex than women who had to seek out ECPs. Taken sooner, the ECPs are more likely to be effective. 2. Women given ECPs ahead of time were more likely to use ECPs than women who had to go to a provider to get ECPs. 3. Women continued to use other contraceptive methods as they did before obtaining ECPs in advance.',
                            ],
                        ],
                        10 => [
                            'title' => 'Should women use ECPs as a regular method of contraception?',
                            'values' => [
                                'No. Nearly all other contraceptive methods are more effective in preventing pregnancy. A woman who uses ECPs regularly for contraception is more likely to have an unintended pregnancy than a woman who uses another contraceptive regularly. Still, women using other methods of contraception should know about ECPs and how to obtain them if needed. For example, if a condom breaks or a woman misses 3 or more combined oral contraceptive pills.',
                            ],
                        ],
                        11 => [
                            'title' => 'If a woman buys ECPs over the counter, can she use them correctly?',
                            'values' => [
                                'Yes. Taking ECPs is simple, and medical supervision is not needed. Studies show that young and adult women find the label and instructions easy to understand. ECPs are approved for over-the-counter sales or nonprescription use in many countries.',
                            ],
                        ],
                    ),
                ],
            ))
        ]);

        FaqGroup::find(5)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => 'Questions and Answers About Female Sterilization',
                    'content' => array(
                        0 => [
                            'title' => 'Will sterilization change a woman’s monthly bleeding or make monthly bleeding stop?',
                            'values' => [
                                'No. Most research finds no major changes in bleeding patterns after female sterilization. If a woman was using a hormonal method or IUD before sterilization, her bleeding pattern will return to the way it was before she used these methods. For example, women switching from combined oral contraceptives to female sterilization may notice heavier monthly bleeding as their monthly bleedingreturns to usual patterns. Note, however, that a woman’s monthly bleeding usually becomes less regular as she approaches menopause.',
                            ],
                        ],
                        1 => [
                            'title' => 'Will sterilization make a woman lose her sexual desire? Will it make her fat?',
                            'values' => [
                                'No. After sterilization a woman will look and feel the same as before. She can have sex the same as before. She may find that she enjoys sex more because she does not have to worry about getting pregnant. She will not gain weight because of the setrilization procedure.',
                            ],
                        ],
                        2 => [
                            'title' => 'Should sterilization be offered only to women who have ahd a certain number of children, who have reached a certain age, or who are married?',
                            'values' => [
                                'No. There is no justification for denying sterilization to a woman just because of her age, number of her living children, or her marital status. Health care providers must not impose rigid rules about age, number of children, age of last child, or marital status. Each woman must be allowed to decide for herself whether or not she will want more children and whether or not to have sterilization.',
                            ],
                        ],
                        3 => [
                            'title' => 'Is it not easier for the woman and the health care provider to use general anaesthesia? Why use local anaesthesia?',
                            'values' => [
                                'Local anaesthesia is safer. General anaesthesia is more risky than the sterilization procedure itself. Correct use of local anaesthesia removes the single greatest source of risk in female sterilization procedures. Also after general anaesthesia women usually feel nauseous. This doesn\'t happen as often after local anaesthesia. When using local anaesthesia with sedation, however, providers must take care not to overdose the woman with the sedative. They also must handle the woman gently and talk with her throughout the procedure. This helps her to stay calm. With many clients, sedatives can be avoided, especially with good counselling with a skilled provider.',
                            ],
                        ],
                        4 => [
                            'title' => 'Does a woman who has had sterilization procedure ever have to worry about getting pregnant again?',
                            'values' => [
                                'Generally, no. Female sterilization is . very effective at preventing pregnancy and is intended to be permanent. It is not 100% effective, however. Women who have been sterilized have a slight risk of becoming pregnant. About 5 of every 1,000 women become pregnant within a year after the procedure. The small risk of pregnancy remains beyond the first year and until the woman reaches menopause.',
                            ],
                        ],
                        5 => [
                            'title' => 'Pregnancy after female sterilization is rare, but why does it happen at all?',
                            'values' => [
                                'Most often it is because the woman was already pregnant at the time of sterilization. In some cases an opening in the fallopian tube develops. Pregnancy also can occur if the provider makes a cut in the wrong place instead of the fallopian tubes.',
                            ],
                        ],
                        6 => [
                            'title' => 'Can steriliztion be reversed if the woman decides she wants another child?',
                            'values' => [
                                'Generally, no. Sterilization is intended to be permanent. People who may want more children should choose a different family planning method. Surgery to reverse sterilization is possible for only some women - those who have enough fallopian tube left. Even among these women, reversal often does not lead to pregnancy. The procedure is difficult and expensive, and providers who are able to perform such surgery are hard to find. When pregnancy does occur after reversal, the risk that the pregnancy will be ectopic is greater than usual. Thus, sterilization should be considered irreversible.',
                            ],
                        ],
                        7 => [
                            'title' => 'Is it better for the woman to have female sterilization or the man to have a vasectomy?',
                            'values' => [
                                'Each couple must decide for themselves which method is best for them. Both are very effective, safe, permanent methods for couples who know that they will not want more children. Ideally, a couple should consider both methods. If both are acceptable to the couple, vasectomy would be preferable because it is simpler, safe, easier and less expensive than female sterilization.',
                            ],
                        ],
                        8 => [
                            'title' => 'Will the female sterilization procedure hurt?',
                            'values' => [
                                'Yes, a little. Women receive local anaesthesia to stop pain, and except in special cases, they remain awake. A woman can feel the health care provider moving her uterus and fallopian tubes. This can be uncomfortable. If a trained anaesthetist or anaesthesiologist and suitable equipment are available, general anaesthesia may be chosen for women who are frightened of pain. A woman may feel sore and weak for several days or even a few weeks after surgery, but she will soon regain her strength.',
                            ],
                        ],
                        9 => [
                            'title' => 'How can health care proveiders help a woman decide about female sterilization?',
                            'values' => [
                                'Provide clear, balanced information about female sterilization and other family planning methods, and help a woman think through her decision fully. Thoroughly discuss her feelings about having children and ending her fertility. For example, a provider can help a woman think how she would feel about possible life changes such as a change of partner or a child’s death.',
                            ],
                        ],
                        10 => [
                            'title' => 'Does female sterilization increase the risk of ectopic pregnancy?',
                            'values' => [
                                'No. On the contrary, female sterilization greatly reduces the risk of ectopic pregnancy. Ectopic pregnancies are very rare among women who have had a sterilization procedure. The rate of ectopic pregnancy among women after female sterilization is 6 per 10,000 women per year. On the rare occasions that sterilization fails and pregnancy occurs, 33 of every 100 of these pregnancies are ectopic. Thus, most pregnancies after sterilization failure are not ectopic. Still, ectopic pregnancy can be life-threatening, so a provider should be aware that ectopic pregnancy is possible if sterilization fails.',
                            ],
                        ],
                        11 => [
                            'title' => 'Where can female sterilizaiton be performed?',
                            'values' => [
                                'If no pre-existing medical conditions require special arrangements: 1. Minilaparotomy can be provided in maternity centers and basic health facilities where surgery can be done. These include both permanent and temporary facilities that can refer the woman to a higher level of care in case of emergency. 2. Laparoscopy requires a better equipped center, where the procedure is performed regularly and an anaesthetist is available.',
                            ],
                        ],
                        12 => [
                            'title' => 'What are transcervical methods of sterilization?',
                            'values' => [
                                'Transcervical methods involve new ways of reaching the fallopian tubes, through the vagina and uterus. A microcoil, Essure, is already available in some countries. Essure is a spring-like device that a specifically trained clinician using a viewing instrument (hysteroscope) inserts through the vagina into the uterus and then into each fallopian tube. Over the 3 months following the procedure, scar tissue grows into the device. The scar tissue permanently plugs the fallopian tubes so that sperm cannot pass through to fertilize an egg. Essure is unlikely to be introduced in low-resource settings soon, however, because of the high cost and complexity of the viewing instruments required for insertion.',
                            ],
                        ],
                    ),
                ],
            ))
        ]);

        FaqGroup::find(6)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => 'Questions and Answers About Fertility Awareness Methods',
                    'content' => array(
                        0 => [
                            'title' => 'Can only well-educated couples use fertility awareness methods?',
                            'values' => [
                                'No. Couples with little or no formal schooling can and do use fertility awareness methods effectively. Couples must be highly motivated, well-trained in their method, and committed to avoiding unprotected sex during the fertile time.',
                            ],
                        ],
                        1 => [
                            'title' => 'Are fertility awareness methods reliable?',
                            'values' => [
                                'For many couples, these methods provide reliable information about the fertile days. If the couple avoids vaginal sex, or uses condoms or a diaphragm during the woman’s fertile time, fertility awareness methods can be very effective. Using withdrawal or spermicides during the fertile time is less effective.',
                            ],
                        ],
                        2 => [
                            'title' => 'What is new about the newer fertility awareness methods, the Standard Days Method and the TwoDay Method?',
                            'values' => [
                                'These new fertility awareness methods are easier to use correctly than some of the older ones. Thus, they could appeal to more couples and be more effective for some people. They are like older methods, however, in that they rely on the same ways of judging when a woman might be fertile- by keeping track of the days of the cycle for the Standard Days Method and by cervical secretions for the TwoDay method. So far, there are few studies of these methods. A clinical trial found that, as the Standard Days Method was commonly used by women who had most cycles between 26 and 32 days long, there were 12 pregnancies per 100 women over the first year of use. In a clinical trial of the TwoDay Method as it was commonly used, there were 14 pregnancies per 100 women over the first year of use. This rate is based on those oho remained in the study. Women who detected secretions on fewer than 5 days or more than 14 days in each cycle were exclude.',
                            ],
                        ],
                        3 => [
                            'title' => 'How likely is woman to become pregnant if she has sex during her monthly bleeding?',
                            'values' => [
                                'During monthly bleeding the chances of pregnancy are low but not zero. Bleeding itself does not prevent pregnancy, and it does not promote pregnancy, either. In teh first several days of monthly bleeding, the chances of pregnancy are lowest. For example, on day 2 of the cycle (counting from the first day of the bleeding as day 1), the chance of getting pregnant is extremely low (less than 1%). As the days pass, the chances of pregnancy increase, whether or not she is still bleeding. The risk of pregnancy rises until ovulation. The day after ovulation the chances of pregnancy begins to drop steadily. Some fertility awareness methods that depend on cervical secretions advise avoiding unprotected sex during monthly bleeding because cervical secretions cannot be detected during bleeding and there is a small risk of ovulation at this time.',
                            ],
                        ],
                        4 => [
                            'title' => 'How many days of abstinence or use of another methods might be required for each of the fertility awareness methods?',
                            'values' => [
                                'The number of days varies based on the woman’s cycle length. The average number of days a woman would be considered fertile- and would need to abstain or use another method- with each method is: Standard Days Method, 12 days: TwoDay Method, 13 days; symptothermal method, 17 days; ovulation method, 18 days.',
                            ],
                        ],
                    ),
                ],
            ))
        ]);

        FaqGroup::find(7)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => 'Questions and Answers About Implants',
                    'content' => array(
                        0 => [
                            'title' => 'Do users of implants require follow-up visits?',
                            'values' => [
                                'No. Routine periodic visits are not necessary for implant users. Annual visits may be helpful for other preventive care, but the are not required. Of course, women are welcome to return at any time with questions.',
                            ],
                        ],
                        1 => [
                            'title' => 'Can implants be left permanently in a woman’s arm?',
                            'values' => [
                                'Leaving the implants in place beyond their effective lifespan is generally not recommended if the woman continues to be a t risk of pregnancy. The imlants themselves are not dangerous, but as the hormone levels in the implants drop, they become less and less effective.',
                            ],
                        ],
                        2 => [
                            'title' => 'Do implants cause cancer?',
                            'values' => [
                                'No. Studies have not shown increased risk of any cancer with use of implants.',
                            ],
                        ],
                        3 => [
                            'title' => 'How long does it take to become pregnant after the implants are removed?',
                            'values' => [
                                'Women who stop using implants can become pregnant as quickly as women who stop nonhormonal methods. Implants do not delay the return of a woman’s fertility after they are removed. The bleeding pattern a woman had before she used implants generally returns after they are removed. Some women may have to wait a few months before their usual bleeding pattern returns.',
                            ],
                        ],
                        4 => [
                            'title' => 'Do implants cause birth defects? Will the fetus be harmed if a woman accidentally becomes pregnant with implants in place?',
                            'values' => [
                                'No. Good evidence shows that implants will not cause birth defects and will not otherwise harm the fetus if a woman becomes pregnant while using implants or accidentally has implants inserted when she is already pregnant.',
                            ],
                        ],
                        5 => [
                            'title' => 'Can implants move around within a woman’s body or come our of her arm?',
                            'values' => [
                                'Implants do not move around in a woman’s body. The implants remain where they are inserted until they re removed. Rarely, a rod may start to com out, most often in the first 4 months after insertion. this usually happens because they were not inserted well or because of an infection where they were inserted. In these cases, the woman will see the implants coming out. Some women may have a sudden change in bleeding pattern. If a woman notices a rod coming out, she should start using a backup method and return to the clinic at once.',
                            ],
                        ],
                        6 => [
                            'title' => 'Do implants increase the risk of ectopic pregnancy?',
                            'values' => [
                                'No. On the contrary, implants greatly reduce the risk of ectopic pregnancy. Ectopic pregnancies are extremely rare among implant users. The rate of ectopic pregnancy among women with implant s is 6 per 100, 000 women per year. The rate of ectopic pregnancy among women in the united States using no contraceptive method is 6450 per 100, 000 women per year. On the very rare occasions that implants fail and pregnancy occurs, 10 to 17 of every 100 of these pregnancies are ectopic. Thus, the great majority of pregnancies after implants fail are not ectopic. Still, ectopic pregnancy can be life-threatening, so a provider should be aware that ectopic pregnancy is possible if implants fail.',
                            ],
                        ],
                        7 => [
                            'title' => 'How soon can a breastfeeding woman start a progestin-only method - implants, progestin-only pills or injectables, or LNG-IUD?',
                            'values' => [
                                'WHO guidance calls ofor waiting until at least 6 weeks after childbirth to start a progestin-only contraceptive (4 weeks for the LNG-IUD). In special cases a provider could make the clinical judgment that a woman can start a progestin-only method sooner. A WHO expert consultation in 2008 endorsed WHO’s current guidance, based on theoretical concerns about the effect on infant development of hormones in breast milk. These experts noted, however, that, where pregnancy risks are high and access to services is limited, progestin-only methods may be among the few available. Also, starting implants and IUDs requires providers with special training. These providers may be available only when a woman gives birth. The experts concluded, “Any decisions regarding choice of a contraceptive method should also consider these facts”. Also note: Guidance in some countries, based on their own expert panel reviews, allows breastfeeding women to start progestin-only methods at any time. This includes starting immediately postpartum, a long-standing practice in these countries.',
                            ],
                        ],
                        8 => [
                            'title' => 'Should heavy women avoid implants?',
                            'values' => [
                                'No. These women should know, however, that they need to have jadelle or no imlants replaced sooner to maintain a high level of protection from pregnancy. In studies of Norplant implants pregnancy rates among women who weighed 70-79kg were 2 per 100 women in the sixth year of use. Such women should have their implants replaced, if they wish , after 5 years. among women whoused Nor plant or Jadelle imlants and who weighed 80kg or more, the pregnancy rate was 6 per 100 in the fifth year of use. These women should have their implants replaced after 4 years. Studies of implanon have not found that weight decreases effectiveness within the lifespan approved for this type of implant.',
                            ],
                        ],
                        9 => [
                            'title' => 'What would be done if an implant user has an ovarian cyst?',
                            'values' => [
                                'The great majority of cysts are not true cysts but actually fluid-filled structures in the ovary (follicles) that continue to grow beyond the usual size in a . normal menstrual cycle. They may cause some mild abdominal pain but they only require treatment if they grow abnormally large, twist or burst. These follicles usually go a away without treatment',
                            ],
                        ],
                        10 => [
                            'title' => 'Can a woman work soon after having implants inserted?',
                            'values' => [
                                'Yes, a woman can do her usual work immediately after leaving the clinic as long as she does not bump the insertion site or get it wet.',
                            ],
                        ],
                        11 => [
                            'title' => 'Must a woman have a pelvic examination before she can have implants inserted?',
                            'values' => [
                                'No. Instead, asking the right questions can help the provider be reasonably certain she is not pregnant. No condition that can be detected by a pelvic examination rules out use of implants.',
                            ],
                        ],
                    ),
                ],
            ))
        ]);

        FaqGroup::find(10)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => 'Questions and Answers About the Lactational Amenorrhea Method',
                    'content' => array(
                        0 => [
                            'title' => 'Can LAM be an effective method of family planning?',
                            'values' => [
                                'Yes. LAM is very effective if the woman’s monthly bleeding has not returned, she is fully or nearly breastfeeding, and her baby is less than 6 months old.',
                            ],
                        ],
                        1 => [
                            'title' => 'When should a mother start giving her baby other foods besides breast milk?',
                            'values' => [
                                'Ideally, when the baby is 6 months old. Along with other foods, breast milk should be a major part of the child’s diet, through the child’s second year or longer.',
                            ],
                        ],
                        2 => [
                            'title' => 'Can women use LAM if they work away from home?',
                            'values' => [
                                'Yes. Women who are able to keep infants with them at work or nearby and are able to breastfeed frequently can rely on LAM as long as they meed all 3 criteria for LAM. Women who are separated from their infants can use LAM if breastfeeds are less than 4 hours apart. Women can also express their breast milk at least every 4 hours , but pregnancy rates may be slightly higher for women who are separated from their infants. The one study that assessed use of LAM among working women estimated a pregnancy rate of 5 per 100 women during the first 6 months after childbirth, compared with about 2 per 100 women as LAM is commonly used.',
                            ],
                        ],
                        3 => [
                            'title' => 'What if a woman learns that she has HIV while she is using LAM? Can she continue breastfeeding and using LAM?',
                            'values' => [
                                'If a woman is newly infected with HIV, the risk of transmission through breastfeeding may be higher than if she was infected earlier, because there is more HIV in her body. The breastfeeding recommendation is the same as for other HIV-infected women, however, HIV-infected mothers or their infants should receive the appropriate ARV therapy, and mothers should exclusively breastfeed their infants for the first 6 months of life, then introduce appropriate complementary foods and continue breastfeeding for the first 12 months of lie. At 6 months or earlier if her monthly bleeding has returned or she stops exclusive breastfeeding she should begin to use another contraceptive method in place of LAM and continue to use condoms.',
                            ],
                        ],
                    ),
                ],
            )),
        ]);

        FaqGroup::find(11)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => 'Questions and Answers About Progestin-Only Pills',
                    'content' => array(
                        0 => [
                            'title' => 'Can a woman who is breastfeeding safely use POPs?',
                            'values' => [
                                'Yes. This is a good choice for a breastfeeding mother who wants to use pills POPs are safe for both the mother and the baby, starting as early as 6 weeks after giving birth. They do not affect milk production.',
                            ],
                        ],
                        1 => [
                            'title' => 'What should a woman do when she stops breastfeeding her baby? Can she continue taking POPs?',
                            'values' => [
                                'A woman who is satisfied with using POPs can continue using them when she has stopped breastfeeding. She is less protected from pregnancy than when breastfeeding, however. She can switch to another method if she wishes.',
                            ],
                        ],
                        2 => [
                            'title' => 'Do POPs cause birth defects? Will the fetus be harmed if a woman accidentally takes POPs while she is pregnant?',
                            'values' => [
                                'No. Good evidence shows that POPs will not cause birth defects and will not otherwise harm the fetus if a woman becomes pregnant while taking POPs or accidentally takes POPs when she is already pregnant.',
                            ],
                        ],
                        3 => [
                            'title' => 'How long does it take to become pregnant after stopping POPs?',
                            'values' => [
                                'omen who stop using POPs can become pregnant as quickly as women who stop using nonhormonal methods. POPs do not delay the return of a woman’s fertility after she stops taking them. The bleeding pattern a woman had before she used POPs generally returns after she stops taking them. Some women may have to wait a few months before their usual bleeding pattern returns.',
                            ],
                        ],
                        4 => [
                            'title' => 'If a woman does not have monthly bleeding while taking POPs, does this mean that she is pregnant?',
                            'values' => [
                                'Probably not, especially if she is breastfeeding. If she has been taking her pills every day, she is probably not pregnant and can keep taking her pills. If she is still worried after being reassured, she can be offered a pregnancy test, if available, or referred for one. If not having monthly bleeding bothers her, switching to another method may help- but not to a progestin-only injectable.',
                            ],
                        ],
                        5 => [
                            'title' => 'Must the POP be taken every day?',
                            'values' => [
                                'Yes. All of the pills in the POP package contain the hormone that prevents pregnancy. If a woman does not take a pill every day- especially a woman who is not breastfeeding- she could become pregnant.',
                            ],
                        ],
                        6 => [
                            'title' => 'Is it important for a woman to take her POPs at the same time each day?',
                            'values' => [
                                'Yes, for 2 reasons. POPs contain very little hormone, and taking a pill more than 3 hours late could reduce their effectiveness for women who are not breastfeeding. (Breastfeeding women have the additional protection from pregnancy that breastfeeding provides, so taking pills late is not as risky.) Also, taking a pill at the same time each day can help women remember to take their pills more consistently. Linking pill taking with a daily activity also helps women remember to take their pills.',
                            ],
                        ],
                        7 => [
                            'title' => 'Do POPs cause cancer?',
                            'values' => [
                                'No. Few large studies exist on POPs and cancer, but smaller studies of POPs are reassuring. Larger studies of implants have not shown any increased risk of cancer. Implants contain hormones similar to those used in POPs, and, during the first few years of implant use, at about twice the dosage.',
                            ],
                        ],
                        8 => [
                            'title' => 'Can POPs be used asa emergency contraceptive pills (ECPs) after unprotected sex?',
                            'values' => [
                                'Yes. As soon as possible, but no more than 5 days after unprotected sex, a woman can take POPs as ECPs. Depending on the type of POP, she will have to take 40 to 50 pills. This is many pills, but it is safe because there is very little hormone in each pill.',
                            ],
                        ],
                        9 => [
                            'title' => 'Do POPs change women’s mood or sex drive?',
                            'values' => [
                                'Generally, no. Some women using POPs report these complaints. The great majority of POP users do not report any such changes, however, and some report that both mood and sex drive improve. It is difficult to tell whether such changes are due to the POPs or to other reasons. Providers can help a client with these problems. There is no evidence that POPs affect women’s sexual behaviour.',
                            ],
                        ],
                        10 => [
                            'title' => 'What should be done if a POP user has an ovarian cyst?',
                            'values' => [
                                'The great majority of cysts are not true cysts but actually fluid-filled structures in the ovary (follicles) that continue to grow beyond the usual size in a normal menstrual cycle. They may cause some mild abdominal pain, but they only require treatment if they grow abnormally large, twist, or burst. These follicles usually go away without treatment.',
                            ],
                        ],
                        11 => [
                            'title' => 'Do POPs increase the risk of ectopic pregnancy?',
                            'values' => [
                                'No. On the contrary, POPs reduce the risk of ectopic pregnancy. Ectopic pregnancies are rare among POP users. The rate of ectopic pregnancy among women using POPs is 48 per 10,000 women per year. The rate of ectopic pregnancy among women in the United States using no contraceptive method is 65 per 10,000 women per year. On the uncommon occasions that POPs fail and pregnancy occurs, 5 to 10 of every 100 of these pregnancies are ectopic. Thus, the great majority of pregnancies after POPs fail are not ectopic. Still, ectopic pregnancy can be life-threatening, so a provider should be aware that ectopic pregnancy is possible if POPs fail.',
                            ],
                        ],
                    ),
                ],
            )),
        ]);

        FaqGroup::find(12)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => 'Questions and Answers About Sexually Transmitted Infections, Including HIV',
                    'content' => array(
                        0 => [
                            'title' => 'Does having another STI place a person at greater risk of infection if they are exposed to HIV?',
                            'values' => [
                                'Yes. In particular, infections that cause sores on the genitals such as chancroid and syphilis increase a person’s risk of becoming infected if exposed to HIV, Other STIs, too, can increase the risk of HIV infection.',
                            ],
                        ],
                        1 => [
                            'title' => 'Does using a condom only some of the time offer any protection from STIs, including HIV?',
                            'values' => [
                                'For best protection, a condom should be used with every act of sex. In some cases, however, occasional use can be protective. For example, if a person has a regular, faithful partner and has one act of sex outside of the relationship, using a condom for that one act can be very protective. For people who are exposed to STIs, including HIV, frequently, however, using a condom only some of the time will offer limited protection.',
                            ],
                        ],
                        2 => [
                            'title' => 'Who is more at risk of becoming infected with an STI - men or women?',
                            'values' => [
                                'If exposed to STIs, women are more likely to become infected than men due to biological factors. Women have a greater area of exposure (the cervix and the vagina) than men, and small tears may occur in the vaginal tissue during sex, making an easy pathway for infection.',
                            ],
                        ],
                        3 => [
                            'title' => 'Can HIV be transmitted through hugging? Shaking hands? Mosquito bites?',
                            'values' => [
                                'HIV cannot be transmitted through casual contact. This include closed mouth kissing, hugging, shaking hands, and sharing food, clothing, or toilet seats. The virus cannot survive long outside of the human body, Mosquitoes cannot transmit HIV, either.',
                            ],
                        ],
                        4 => [
                            'title' => 'Is there any truth to rumours that condoms are coated with HIV?',
                            'values' => [
                                'No, these rumours are false. Some condoms are covered with a wet or a powder-like material such as spermicide or cornstarch, but these are materials used for lubrication, to make sex smoother.',
                            ],
                        ],
                        5 => [
                            'title' => 'Will having sex with a virgin cure someone with an STI, including HIV?',
                            'values' => [
                                'No. Instead, this practice only risks infecting the person who has not yet had sex.',
                            ],
                        ],
                        6 => [
                            'title' => 'Will washing the penis or vagina after sex lower the risk of becoming infected with an STI?',
                            'values' => [
                                'Genital hygiene is important and a good practice. There is no evidence, however, that washing the genitals prevents STIs. In fact, vaginal douching increases a woman’s risk of acquiring STIs, including HIV, and pelvic inflammatory disease. If exposure to HIV is certain, treatment with antirectoviral medications (post-exposure prophylaxis), where available, can help reduce HIV transmission. If exposure to other STIs is certain, a provider can treat presumptively for those STIs - that is, treat the client as if he or she were infected.',
                            ],
                        ],
                        7 => [
                            'title' => 'Does pregnancy place women at increased risk of becoming infected with HIV?',
                            'values' => [
                                'Current evidence is conflicting as to whether pregnancy increases a woman’s chances of infection if exposed to HIV. If she does become infected with HIV during pregnancy, however, the chances that HIV will be transmitted to her baby during pregnancy, delivery, and childbirth may be at their highest because she will have a high level of virus in her blood. Thus, it is important for pregnant women to protect themselves from HIV and other STIs through condom use, mutual faithfulness, or abstinence. If a pregnant woman thinks that she may have HIV, she should seek HIV testing. Resources may be available to help her prevent transmitting HIV to her baby during pregnancy, delivery, and childbirth.',
                            ],
                        ],
                        8 => [
                            'title' => 'Is pregnancy especially risky for women with HIV/AIDS and their infants?',
                            'values' => [
                                'Pregnancy will not make the woman’s condition worse. HIV/AIDS may increase some health risks of pregnancy, however, and may also affect the health of the infant. Women with HIV are at greater risk of developing anemia and infection after vaginal delivery or caesarean section. The level of risk depends on such factors as a woman’s health during pregnancy, her nutrition, and the medical care she receives. Also, the risk of these health problems increases as HIV infection progresses into AIDS. Further, women with HIV/AIDS are at greater risk of having preterm births, stillbirths, and low birthweight babies.',
                            ],
                        ],
                        9 => [
                            'title' => 'Does using hormonal contraception increase the risk of becoming infected with HIV?',
                            'values' => [
                                'The best evidence is reassuring. Recent studies among family planning clients in Uganda and Zimbabwe and women in a study in South Africa found that users of DMPA, NET-EN, or combined oral contraceptives were no more likely to become infected with HIV than women using nonhormonal methods. Use hormonal methods is not restricted for women at high risk for HIV or other STIs.',
                            ],
                        ],
                        10 => [
                            'title' => 'How well do condoms help protect agains HIV infection?',
                            'values' => [
                                'On average, condoms are 80% to 95% effective in protecting people from HIV infection when used correctly with every act of sex. This means that condom use prevents 80% to 95% of HIV transmissions that would have occurred without condoms. (It does not mean that 5% to 20% of condom users will become infected with HIV.) For example, among 10,000 uninfected women whose partners have HIV, if each couple has vaginal sex just once and has no additional risk factors for infection, on average: 1. If all 10,000 did not use condoms, about 10 women would likely become infected with HIV. 2. IF all 10,000 used condoms correctly, 1 or 2 women would likely become infected with HIV.',
                                'The chances that a person who is exposed to HIV will become infected can vary greatly. These chances depend on the partner’s stage of HIV infection (early and late stages are more infectious), whether the person exposed has other STIs (increases susceptibility), male circumcision status (uncircumcised men are more likely to become infected with HIV), and pregnancy (women who are pregnant may be at higher risk of infection), among other factors. On average, women face twice the risk of infection, if exposed, that men do.',
                            ],
                        ],
                    ),
                ],
            )),
        ]);

        FaqGroup::find(13)->faq()->create([
            'content' => json_encode(array(
                0 => [
                    'title' => 'Questions and Answers About Vasectomy',
                    'content' => array(
                        0 => [
                            'title' => 'Will vasectomy make a man lose his sexual ability? Will it make him weak or fat?',
                            'values' => [
                                'No. After vasectomy,  a man will look and feel the same as before. He can have sex the same as before. His erections will be as hard as hard and last as long as before, and ejaculations of semen will be the same. He can work as hard as before, and will not gain weight because of the vasectomy.',
                            ],
                        ],
                        1 => [
                            'title' => 'Will there be any long-lasting pain from vasectomy?',
                            'values' => [
                                'Some men report having chronic pain or discomfort in the scrotum or testicles that can last from 1 to 5 years or more after a vasectomy. In the largest studies, involving several thousand men, less than 1% reported pain in the scrotum or testicles that had to be treated with surgery. In smaller studies, of about 200 men, as many as 6% reported severe pain in the scrotum or testicles more than 3 years after the vasectomy. In a similar group of men who did not have vasectomies, however, 2% reported similar pain. Few men with severe pain say that they regret having the vasectomy. The cause of the pain is unknown. It may result from pressure caused by the build-up of sperm that has leaked from an improperly sealed or tied vas deferens, or from nerve damage. Treatments include elevating the scrotum and taking pain relievers. An anaesthetic can be injected into the spermatic cord to numb the nerves to the testicles. Some providers report that surgery to remove the painful site or reversing the vasectomy relieves the pain. Sever, long-lasting pain following vasectomy is uncommon, but all men considering a vasectomy should be told about this risk.',
                            ],
                        ],
                        2 => [
                            'title' => 'Does a man need to use another contraceptive method after a vasectomy?',
                            'values' => [
                                'Yes, for the first 3 months. If his partner has been using a contraceptive method, she can continue to use during this time. Not using another method for the first 3 months is the main cause of pregnancies among couples relying on vasectomy.',
                            ],
                        ],
                        3 => [
                            'title' => 'Is it possible to check if a vasectomy is working?',
                            'values' => [
                                'Yes. A provider can examine a semen sample under a microscope to see if it still contains sperm. If the provider sees no moving sperm, the vasectomy is working. A semen examination is recommended at any time after 3 months following the procedure, but is not essential. If there is less than one nanomotile sperm per 10 high-power fields (less than 100,000 sperm per millimetre) in the fresh sample, then the man can rely on his vasectomy and stop using backup methods for contraception. If his semen contains more moving sperm, the man should continue to use backup method and return to the clinic monthly for a semen analysis. If his semen continues to have moving sperm, he may need to have a repeat vasectomy.',
                            ],
                        ],
                        4 => [
                            'title' => 'What if a man’s partner gets pregnant?',
                            'values' => [
                                'Every man having a vasectomy should know that vasectomies sometimes fail and his partner could become pregnant as a result. He should not make the assumption that his partner was unfaithful if she becomes pregnant. If a man’s partner becomes pregnant during the first 3 months after his vasectomy, remind the man that for the first 3 months they need to use another contraceptive method. If possible, offer a semen analysis and, if sperm are found, a repeat vasectomy.',
                            ],
                        ],
                        5 => [
                            'title' => 'Will the vasectomy stop working after a time?',
                            'values' => [
                                'Generally, no. Vasectomy is intended to be permanent. In rare cases, however, the tubes that carry sperm grow back together and the man will require a repeat vasectomy.',
                            ],
                        ],
                        6 => [
                            'title' => 'Can a man have his vasectomy reversed if he decides that he wants another child?',
                            'values' => [
                                'Generally, no. Vasectomy is intended to be permanent. People who may want more children should choose a different family planning method. Surgery to reverse vasectomy is possible for only some men and reversal often does not lead to pregnancy. The procedure is difficult and expensive, and providers who are able to perform such surgery are hard to find. Thus, vasectomy should be considered irreversible.',
                            ],
                        ],
                        7 => [
                            'title' => 'Is it better for the man to have a vasectomy or for the woman to have female sterilization?',
                            'values' => [
                                'Each couple must decide for themselves which method is best for them. Both are very effective, safe, permanent methods for couples who know that they will not want more children. Ideally, a couple should consider both methods. If both are acceptable to the couple, vasectomy would be preferable because it is simpler, safer, easier, and less expensive than female sterilization.',
                            ],
                        ],
                        8 => [
                            'title' => 'How can health care providers help a man decide about vasectomy?',
                            'values' => [
                                'Provide clear, balanced information about vasectomy and other family planning methods, and help a man think through his decision fully. Thoroughly discuss his feelings about having children and ening his fertility. For example, a provider can help a man think how he would feel about possible life changes such as a change of partner or a child’s death.',
                            ],
                        ],
                        9 => [
                            'title' => 'Should vasectomy be offered only to men who have reached a certain age or have a certain number of children?',
                            'values' => [
                                'No. There is no justification for denying vasectomy to a man just because of his age, the number of his living children, or his marital status. Health care providers must not impose rigid rules about age, number of children, age of last child, or marital status. Each man must be allowed to decide for himself whether or not he will want more children and whether or not to have vasectomy.',
                            ],
                        ],
                        10 => [
                            'title' => 'Does vasectomy increase a man’s risk of cancer or heart disease later in life?',
                            'values' => [
                                'No. Evidence from large, well-designed studies shows that vasectomy does not increase risks of cancer of the testicles (testicular cancer) or cancer of the prostate (prostate cancer) or heart disease.',
                            ],
                        ],
                        11 => [
                            'title' => 'Can a man who has vasectomy transmit or become infected with sexually transmitted infections (STIs), including HIV?',
                            'values' => [
                                'Yes. Vasectomies do not protect against STIs, including HIV. All men at risk of STIs, including HIV, whether or not they have had vasectomies, need to use condoms to protect themselves and their partners from infection.',
                            ],
                        ],
                        12 => [
                            'title' => 'Where can vasectomies be performed?',
                            'values' => [
                                'If no pre-existing medical conditions require special arrangements, vasectomy can be performed in almost any health facility, including health care centres, family planning clinics, and the treatment rooms of private doctors. Where other vasectomy services are not available, mobile teams can perform vasectomies and any follow-up examinations in basic health facilities and specially equipped vehicles, so long as basic medications, supplies, instruments, and equipment can be made available.',
                            ],
                        ],
                    ),
                ],
            )),
        ]);
    }
}
