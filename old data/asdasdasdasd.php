<?php

$connection = mysqli_connect('localhost', 'root', '', 'clinics');

$query = "INSERT INTO `stomatologiya` (`name`, `adress`, `phone`, `location_1`,`location_2`) ";
$query .= "VALUES  

('	AzəriMed - Kanon-Nəsir	 ','	Azərbaycan Respublikası, Bakı, Nərimanov r-nu, Asif Məmmədov küç. ev 30D, AZ1000	 ','	994 55 455 81 43	 ','	49.8809814453125	 ','	40.39406967163086	 '),
('	AzəriMed- Günəbaxan	 ','	Azərbaycan Respublikası, Bakı, Yasamal r-nu, Firuddin Ağayev küç. ev 5, AZ1000	 ','	994 55 455 56 38	 ','	49.81224822998047	 ','	40.37530517578125	 '),
('	AzəriMed-Kanon - Almaz/Xaçmaz	 ','	Azərbaycan Respublikası, Xaçmaz, N.Nərimanov küç., AZ2700	 ','	994 55 455 85 96	 ','	41.4614832035721	 ','	48.7992184978801	 '),
('	AzəriMed-Kanon - Aran/Biləsuvar	 ','	Azərbaycan Respublikası, Biləsuvar, H.Əliyev küç., ev 40 E, AZ1300	 ','	994 55 455 89 68	 ','	39.4545995604547	 ','	48.5468466266807	 '),
('	AzəriMed-Kanon - Balzam	 ','	Azərbaycan Respublikası, Xırdalan şəhəri, M.Rəsulzadə ev 1, m. 1	 ','	994 55 455 81 26	 ','	40.4535065301217	 ','	49.7504811402038	 '),
('	AzəriMed-Kanon - Enterol	 ','	Azərbaycan Respublikası, Bakı, Xətai r-nu, M. Hadi küç., 41, AZ1000	 ','	994 55 455 85 78	 ','	40.3841887710466	 ','	49.9545380690373	 '),
('	AzəriMed-Kanon - Favorit	 ','	Azərbaycan Respublikası, Bakı, Sabunçu r-nu, Bakıxanov qəs, Sülh küç, 1D, AZ1000	 ','	994 55 455 85 72	 ','	40.4178923603822	 ','	49.9604119978482	 '),
('	AzəriMed-Kanon - Feromed	 ','	Azərbaycan Respublikası, Bakı, Nizami r-nu, Q. Qarayev pr, 26, AZ1000	 ','	994 55 455 85 97	 ','	40.4176338353684	 ','	49.9319567536956	 '),
('	AzəriMed-Kanon - General	 ','	Azərbaycan Respublikası, Bakı, Xətai r-nu, Xudu Məmmədov küç. ev 32 A, AZ1000	 ','	994 55 455 81 07	 ','	49.953476	 ','	40.3709526	 '),
('	AzəriMed-Kanon - Gönçə/Gəncə	 ','	Azərbaycan Respublikası, Gəncə, H.Əliyev pr.  ilə  Atatürk  pr. kəsişməsi , AZ2000	 ','	994 55 455 85 49	 ','	40.69775753008175	 ','	46.36125165367889	 '),
('	AzəriMed-Kanon - Harmony	 ','	Azərbaycan Respublikası, Bakı, Nəsimi r-nu, Dilare Eliyeva kucesi 214, AZ1000	 ','	994 55 455 90 70	 ','	40.377292629659	 ','	49.8463267536692	 '),
('	AzəriMed-Kanon - Immuno	 ','	Azərbaycan Respublikası, İmişli, Heydər Əliyev pr.164, AZ3000	 ','	994 55 455 90 57	 ','	39.8701196811795	 ','	48.0604112113249	 '),
('	AzəriMed-Kanon - İzmir	 ','	Azərbaycan Respublikası, Bakı, Yasamal r-nu, Əbdürrəhim bəy Haqverdiyev küç. ev 11, AZ1000	 ','	994 55 455 58 16	 ','	49.8165436	 ','	40.3803635	 '),
('	AzəriMed-Kanon - Lutemax	 ','	Azərbaycan Respublikası, Bakı, Yasamal r-nu, Şərifzadə küç., 314, AZ1000	 ','	994 55 455 85 38	 ','	40.3822000215592	 ','	49.8044049690373	 '),
('	AzəriMed-Kanon - Mərkəz/Lənkəran	 ','	Azərbaycan Respublikası, Lənkəran, Həzi Aslanov küç, AZ4200	 ','	994 55 455 85 69	 ','	38.7549443631431	 ','	48.8520129112917	 '),
('	AzəriMed-Kanon - Nar	 ','	Azərbaycan Respublikası, Bakı, Nərimanov r-nu, Ağa Nemətulla küç. ev 211 B, AZ1000	 ','	994 12 564 87 86	 ','		 ','		 '),
('	AzəriMed-Kanon - Naturalist	 ','	Azərbaycan Respublikası, Bakı, Səbail r-nu,  Əhməd Cavad küç., 22, AZ1000	 ','	994 55 455 85 37	 ','	40.36987942793	 ','	49.8344882536942	 '),
('	AzəriMed-Kanon - Okean	 ','	Azərbaycan Respublikası, Bakı, Yasamal r-nu, B.Bağırova küç., 14, AZ1000	 ','	994 55 455 85 73	 ','	40.3842489814834	 ','	49.8251969843799	 '),
('	AzəriMed-Kanon - Oskar	 ','	Azərbaycan Respublikası, Bakı, Binəqədi r-nu, Mir Cəlal küç. 72, AZ1000	 ','	994 55 455 85 74	 ','	40.4209595889113	 ','	49.8148467690126	 '),
('	AzəriMed-Kanon - Səma	 ','	Azərbaycan Respublikası, Bakı, Binəqədi r-nu, Ş.Məmmədova küç.6 E, AZ1000	 ','	994 55 455 85 46	 ','	40.421414519883	 ','	49.8463232690126	 '),
('	AzəriMed-Kanon - Semaşko	 ','	Azərbaycan Respublikası, Bakı, Nəsimi r-nu, A.Mirqasımov küç., 2, AZ1000	 ','	994 55 455 85 39	 ','	40.3941096157195	 ','	49.8349245843803	 '),
('	AzəriMed-Kanon - Stimol/Sumqayıt	 ','	Azərbaycan Respublikası, Sumqayıt, 2-ci  mkr, Sülh  küçəsi, AZ5000	 ','	994 55 455 85 63	 ','	40.5872089756899	 ','	49.6707269843862	 '),
('	AzəriMed-Kanon - Viktoriya	 ','	Azərbaycan Respublikası, Bakı, Nərimanov r-nu, Təbriz küç. 17, AZ1000	 ','	994 55 455 85 64	 ','	40.3879579733829	 ','	49.8522513690373	 '),
('	AzəriMed-Kanon - Vitamin	 ','	Azərbaycan Respublikası, Bakı, Nəsimi r-nu, H.Əliyev küç., 4, AZ1000	 ','	994 55 455 87 85	 ','	40.4109252996611	 ','	49.8172773248597	 '),
('	AzəriMed-Kanon - Xəmsə/Mingəçevir	 ','	Azərbaycan Respublikası, Mingəçevir, H.Əliyev  prospekti  51 Q  , AZ4500	 ','	994 55 455 85 47	 ','	40.7683360532829	 ','	47.0562259266944	 '),
('	AzəriMed-Zəfəran - 20 Yanvar	 ','	Azərbaycan Respublikası, Bakı, Yasamal r-nu, Zərdabi və M Həsənovun kəsişməsi, AZ1000	 ','	994 55 455 69 51	 ','	40.4042120281025	 ','	49.8063161690379	 '),
('	AzəriMed-Zəfəran - 5 №-li xəstaxana	 ','	Azərbaycan Respublikası, Bakı, Nərimanov r-nu, Fətəli Xan Xoyski küç.,130, AZ1000	 ','	994 55 455 88 02	 ','	40.4030551451771	 ','	49.8625555555188	 '),
('	AzəriMed-Zəfəran - Bərdə	 ','	Azərbaycan Respublikası, Bərdə, Ü. Hacıbəyov küç. 3, AZ0900	 ','	994 55 455 87 99	 ','	40.3728159882696	 ','	47.1260759825045	 '),
('	AzəriMed-Zəfəran - Göyçay	 ','	Azərbaycan Respublikası, Göyçay, Heydər  Əliyev  prospekti ev 53 A, AZ2300	 ','	994 55 455 81 65	 ','	40.649416990666	 ','	47.7478028266907	 '),
('	AzəriMed-Zəfəran - Lökbatan	 ','	Azərbaycan Respublikası, Bakı, Qaradağ r-nu, Lökbatan qəs., 28 MAY küç., AZ1000	 ','	994 55 455 89 10	 ','	40.3219896279471	 ','	49.7330250113384	 '),
('	AzəriMed-Zəfəran - Masallı 1	 ','	Azərbaycan Respublikası, Masallı, 20 Yanvar küç., AZ4400	 ','	994 55 455 58 75	 ','	39.0258262740219	 ','	48.6656113112995	 '),
('	AzəriMed-Zəfəran - Mərdəkan	 ','	Azərbaycan Respublikası, Bakı Xəzər, Mərdəkan qəs.	 ','	994 55 455 90 78	 ','	40.4871118763139	 ','	50.1648227825334	 '),
('	AzəriMed-Zəfəran - Mingəçevir	 ','	Azərbaycan Respublikası, Mingəçevir, H.Əliyev pr., AZ4500	 ','	994 55 455 58 12	 ','	40.7647467362729	 ','	47.0620098248454	 '),
('	AzəriMed-Zəfəran - Neftçilər	 ','	Azərbaycan Respublikası, Bakı, Xətai r-nu, M.Mehtizadə və Y.Səfərov küc. kəsisməsi., AZ1000	 ','	994 55 455 88 01	 ','	40.3805190238593	 ','	49.8638801693156	 '),
('	AzəriMed-Zəfəran - Primorsk	 ','	Azərbaycan Respublikası, Bakı Qaradağ, Sahil qəs., Məhərrəm Seyidov küç.	 ','	994 55 455 90 93	 ','	40.2298231466725	 ','	49.5818103978683	 '),
('	AzəriMed-Zəfəran - Qazax	 ','	Azərbaycan Respublikası, Qazax, Heydər Əliyev küç.71, AZ3500	 ','	994 55 455 81 69	 ','	41.0980257240705	 ','	45.3784893267044	 '),
('	AzəriMed-Zəfəran - Qəbələ	 ','	Azərbaycan Respublikası, Qəbələ, Heydər Əliyev pr., AZ3600	 ','	994 55 455 91 75	 ','	40.9754075824334	 ','	47.8439957267268	 '),
('	AzəriMed-Zəfəran - Quba-2	 ','	Azərbaycan Respublikası, Quba, Heyder Eliyev prospekti.(Avtovagzal erazisi), AZ4000	 ','	994 55 455 88 50	 ','	41.3620851398386	 ','	48.5242305979031	 '),
('	AzəriMed-Zəfəran - Qusar-2	 ','	Azərbaycan Respublikası, Qusar, Qusar seher teze tikilmis xestexananin yani, AZ3800	 ','	994 55 455 87 88	 ','	41.4245760301556	 ','	48.4473755267407	 '),
('	AzəriMed-Zəfəran - Sumqayit	 ','	Azərbaycan Respublikası, Sumqayıt, H.Əliyev pr./məhəllə 40, AZ5000	 ','	994 55 455 89 00	 ','	40.5839798482589	 ','	49.6731244248649	 '),
('	AzəriMed-Zəfəran - Şəki	 ','	Azərbaycan Respublikası, Şəki, Məmmədəmin Rəsulzadə pr., AZ5500	 ','	994 55 455 89 63	 ','	41.198481033949	 ','	47.1739410978981	 '),
('	AzəriMed-Zəfəran - Şirvan	 ','	Azərbaycan Respublikası, Şirvan şəh., Nəriman Nərimanov, 2A	 ','	994 55 455 87 47	 ','	39.9520717334157	 ','	48.9389975113272	 '),
('	AzəriMed-Zəfəran - XMSK	 ','	Azərbaycan Respublikası, Bakı, Səbail r-nu, Badamdar şosse 31, AZ1000	 ','	994 55 455 81 63	 ','	49.809120178222656	 ','	40.35299301147461	 '),
('	Buta - Badamdar3 DTX hospital	 ','	Azərbaycan Respublikası, Bakı, Səbail r-nu, Badamdar qəs., T.Məmmədov küç., 8, AZ1000	 ','	994 55 203 87 86	 ','	40.3371986854426	 ','	49.8053778555168	 '),
('	Buta - Bayıl-2	 ','	Azərbaycan Respublikası, Bakı, Səbail r-nu, Ə. Yaqubov  küç. 6, AZ1000	 ','	994 55 208 00 86	 ','	40.34077621249385	 ','	49.83685039281965	 '),
('	Buta - Mərdəkan 3	 ','	Azərbaycan Respublikası, Xəzər ray.Mərdəkan qəs.S.Yesenin küç.2-ci döngə 2C	 ','	994 55 224 58 59	 ','	50.16419982910156	 ','	40.48714828491211	 '),
('	Buta - Metropark	 ','	Azərbaycan Respublikası, Bakı, Nərimanov r-nu, Təbriz küç., 97, AZ1000	 ','	994 55 250 86 40	 ','	40.404107508044	 ','	49.8730818997235	 '),
('	Buta- Əhmədli	 ','	Azərbaycan Respublikası, Bakı, Xətai r-nu, Məzahir Rüstəmov küç., 22, AZ1000	 ','	994 55 252 22 70	 ','	40.3844306119064	 ','	49.9617578555181	 '),
('	Buta-Azadlıq	 ','	Azərbaycan Respublikası, Bakı, Yasamal r-nu, Süleyman Sani Axundov küç, ev 8
, AZ1000	 ','	994 55 333 13 68	 ','	49.8418389	 ','	40.4251709	 '),
('	Dokta - Eskulap	 ','	Azərbaycan Respublikası, Bakı, Nəsimi r-nu, Rəşid Behbudov küç., 42, AZ1000	 ','	994 51 486 42 00	 ','	40.3800388894118	 ','	49.8440965876666	 '),
('	Dokta - Kaspian	 ','	Azərbaycan Respublikası, Bakı, Səbail r-nu, Bül-Bül pr., 16A, AZ1000	 ','	994 51 333 04 07	 ','	40.3721602555133	 ','	49.8448436843797	 '),
('	Dokta 780 	 ','	Azərbaycan Respublikası, Sumqayıt, 6 mkr Kristal Abşeron
, AZ5000	 ','	994 55 649 72 16	 ','	49.6875801	 ','	40.5805817	 '),
('	Gömrük Hospitalının Apteki	 ','	Azərbaycan Respublikası, Bakı, Yasamal r-nu, K. Kazımzada küç. 118, AZ1000	 ','	994 55 455 69 51	 ','	49.8157959	 ','	40.3783417	 '),
('	Lənkəran aptek	 ','	Azərbaycan Respublikası, Lənkəran, Nizami küçəsi, AZ4200	 ','	994 55 455 85 69	 ','		 ','		 '),
('	MediClub Apteki	 ','	Azərbaycan Respublikası, Bakı, Səbail r-nu, Ü. Hacıbəyov küç., 45, AZ1000	 ','	994 50 220 48 29	 ','	40.3760943930241	 ','	49.8560428274371	 '),
('	MediClub KİDS Apteki	 ','	Azərbaycan Respublikası, Bakı, Izzət Nəbiyev küç 30A , AZ1000	 ','	994 12 525 09 19	 ','	49.82294464111328	 ','	40.358821868896484	 '),
('	Medicom (tibbi ləvazimat)	 ','	Azərbaycan Respublikası, Bakı, Ağ Şəhər. Paris evləri. Yaşıl Ada 1 küçəsi., AZ1000	 ','	994 55 409 36 63	 ','	40.38027991493886	 ','	49.8822166399426	 '),
('	Varitex (tibbi ləvazimat)	 ','	Azərbaycan Respublikası, Bakı, Nəsimi r-nu, Səməd Vurğun 156 D, AZ1000	 ','	994 12 441 54 51	 ','	40.39768210891968	 ','	49.83342719782411	 '),
('	Vita - Əcəmi 3	 ','	Azərbaycan Respublikası, Bakı, Nəsimi r-nu, Cavadxan küç., ev 34, mən.48, AZ1000	 ','	994 55 252 24 30	 ','	40.4097496874299	 ','	49.81482641319	 '),
('	Vita - Retro	 ','	Azərbaycan Respublikası, Bakı, Buzovna qəs., M.Ə.Sabir küç., 22A, AZ1000	 ','	994 12 553 13 80	 ','	40.51831970343332	 ','	50.07011109828481	 '),
('	Vita - Zabrat	 ','	Azərbaycan Respublikası, Bakı, Sabunçu r-nu, Zabrat qəs., Babək pr., 94A, AZ1000	 ','	994 55 255 51 16	 ','	40.4756159137078	 ','	49.9496619113432	 '),
('	Zeytun- NUR- Fexri 2/Sumqayit 	 ','	Azərbaycan Respublikası, Sumqayıt, H.Əliyev pr./məhəllə 40, AZ5000	 ','	994 18 644 55 08	 ','		 ','		 '),
('	Zeytun- Qəbələ 10 	 ','	Azərbaycan Respublikası, Qəbələ, H. Aliyev prospekti (I.B.Qutqasinli kucesi) 357 , AZ3600	 ','	994 50 734 88 99	 ','	47.84941482543945	 ','	40.98186111450195	 '),
('	Zeytun- Vitamin/Gəncə	 ','	Azərbaycan Respublikası, Gəncə, Əlövsət Məmmədov 14B, AZ2000	 ','	994 55 222 89 44	 ','	46.35354995727539	 ','	40.666175842285156	 '),
('	Zeytun- Xırdalan/(Xırdalan Rich)	 ','	Azərbaycan Respublikası, Xırdalan şəhəri, Həzi Aslanov küç 21	 ','	994 77 595 44 66	 ','	49.74446105957031	 ','	40.45500564575195	 '),
('	Zeytun-Sahil- 313	 ','	Azərbaycan Respublikası, Sahil Qesebesi, Emin Quliyev 50	 ','	994 77 376 10 10	 ','	49.5807915	 ','	40.2246399	 ')

";


$create__elements = mysqli_query($connection, $query);

if (!$create__elements) {
    die("QUERY FAILED asdasdas." . mysqli_error($connection));
}