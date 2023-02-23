@extends('kycmodule::layouts.master')

@section('content')
<div class="container-fluid p-md-5">
    <div class="row mt-0">
        <div class="col-12 col-md-8 offset-md-2 p-0 mt-5 mb-2 ">
              <h5 class="mt-5 text-center">VIGEZO NA MASHARTI SOMA KWA MAKINI VIGEZO NA MSAHARTI YA MKOPO</h5>

                              <h5 class="mt-4">1.Ujazaji wa fomu</h5>



                            <p>(i) Fomu hii inapaswa kujazwa baada ya kusoma Vigezo na Masharti ya Mkopo na kuzielewa;</p>



<p class="text-justify">
(ii) Kutoa taarifa zisizo za ukweli kutapelekea maombi yako kukataliwa pasipo maelezo na
 taarifa hizo zinaweza kutumika kama ushahidi dhidi yako endapo italazimu;<br>

Ukamilifu wa Fomu hii ni pamoja na kuhakikisha kuwa yafuatayo yametimia:<br>

Imethibitishwa na kusainiwa na mkopaji<br>
 Iambatanishwe na barua ya Mtendaji wa Serikali ya Mtaa unapofanyia kazi<br>
 Iambatanishwe na Nakala ya kitambulisho cha Taifa.<br>

 Picha ya Pasipoti saizi ya Mkopaji iliyo sawa na itakayowekwa kwenye
  barua ya mtendaji<br>

 Hakikisha kwamba namba ya simu unayoandika na ile ya mdhamini wako ni
  za kwenu na zimesajiliwa rasmi na mamlaka husika



</p>
  <h5>2.Kiasi cha mkopo</h5>

  <p>Mkopo wa kopafasta ni kuanzia kiasi cha Tshs. 30,000/= hadi 5,000,000/= </p>
<h5>3.Muda wa kurejesha mkopo</h5>

<p>(i) Mkopo mkuu, ambao unaanzia Tshs. 30,000/= hadi 200,000/=, utarejeshwa katika kipindi cha mwezi mmora tangu tarene uliootolewa. (kwa mrano: Kama umechukua tarene 10

                      Februari basi marejesho ya Mkopo, kwa viwango sawa kila wiki, yatatakiwa kurejeshwa

                      kuanzia tarehe 17 Februari).</p>

                      <p>(i) Mkopaji anaruhusiwa kurejesha mkopo wote kwa mkupuo mmoja atakaolipa ndani ya wiki moja tangu alipochukua mkopo;</p>
                       <p>(ii) Aidha, mkopaji anaruhusiwa kurejesha zaidi ya kiwango stahili cha marejesho ya wiki ili

                      amalize marejesho mapema ilimradi asipitilize wiki moja kati ya marejesho;</p>

                      <p>(iv) Kurejesha mkopo mapema kutamuwezesha mkopaji kukopa tena na kuharakisha

                      kupanda kiwango cha mkopo anaoweza kuchukua</p>



                        <h5>4.Namna ya kupokea mkopo</h5>

                        <p>Utapewa mkopo wako kupitia Namba ya Simu uliyosajili kopafasta</p>

                          <h5>5.Marejesho ya mkopo</h5>
                      <p>Utatakiwa kulipa riba na ada ya asilimia kumi (10%) tu ya kiasi cha mkopo kwa mwezi ambayo
                       itarejeshwa pamoja na kiasi cha mkopo ulichokopa. (Marejesho = Mkopo mkuu + Riba + Ada ya mkopo ).</p>


                       <h5>6.Kadi ya mkopaji</h5>


                      <p>Mkopaji wa kopafasta, atapatiwa kadi ya mkopo ya kielektroniki, ambayo itatumika kumtambua na kuchukulia mkopo na atapaswa kulipia TShs. 20,000/= tu</p>


                      <h5>7.Kurudisha mkopo</h5>

                      <p>Endapo Mkopaji ataonyesha nidhamu ya kurejesha mkopo kwa wakati na viwango sahihi
                       ataruhusiwa kukopa kiasi hicho hicho mwezi unaofuata au kupanda kiasi kwa kuzingatia
                       vigezo na masharti ya kopafasta</p>


                      <h5>8.Utaratibu wa kupanda</h5>


                      <p>Mkopaji ataweza kupanda kiwango cha mkopo anaoruhusuiwa kukopa endapo atakopa
                       kiwango husika mara tatu (3). Hata hivyo nidhamu ya urejeshaji wa mkopo wa viwango sahihi
                       na wakati husika vitazingatiwa katika upandaji;</p>

                       <h5>9.Utunzaji wa taarifa za mteja</h5>


                      <p>Taarifa za mteja zitatunzwa kwenye Kanzi Data na zitakuwa ni siri ambapo hazitatolewa
                       kwa mtu yeyote asiyehusika zaidi ya mteja mwenyewe na kwa mamlaka za utawala za nchi
                       na Taasisi za fedha.</p>


                      <h5>10. Faida nyinginezo za kadi ya kopafsata</h5>

                      <p>)) Faida nyingine tarajiwa za kuwa na kadi ya kopafasta ni zifuatazo:</p>

                      <p>(i) kuweza kununua bidhaa (zile za viwandani) zinazohusiana na kazi yako kwa mango wa bei punguzo, yaani Loyalty Scheme.</p>
                       <p>(i) Kuwa sehemu va mango jumuishi wa kopafasta kuweza kuwapatia mikopo ya Bima ya Afya.</p>

        </div>
    </div>
    <a href="{{URL::previous()}}"  class="float-start btn btn-success ms-md-5"/><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Rundi Nyuma</a>
    <a href="{{ url('kycmodule/loan/ndinga', [$ndingaLoan->id, 'finish']) }}"  class="float-end btn btn-success me-md-5"/> Mbele <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
</div>

@endsection
