@extends('frontend.layouts.header')

@section('content')
<link href="{{ asset('css/frontend/marketplace.css') }}" rel="stylesheet">
<link href="{{ asset('css/frontend/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/frontend/style2.css') }}" rel="stylesheet">
<link href="{{ asset('css/frontend/social-btn.css') }}" rel="stylesheet">
<link href="{{ asset('css/cryptocoins.css') }}" rel="stylesheet">
<link href="{{ asset('css/frontend/home.css') }}" rel="stylesheet">
<div class="container-fluid padding0" style="margin: -10px -30px 0px -15px;">
    <section id="fh5co-home" data-section="home" class="trans animated">
        <div id="gradient" class="gradient"><canvas class="particles-js-canvas-el" width="1339" height="550" style="width: 100%; height: 100%;"></canvas></div>
        <div class="container">
            <div class="text-wrap">
                <div class="text-inner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="to-animate fadeInUp animated">Collect One-of-a-kind Celebrity Smart Contracts</h1>
                            <h2 class="to-animate fadeInUp animated"><button type="button" class="btn btn-warning" id="start-trading">Start Trading</button></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slant"></div>
    </section>
    <section id="fh5co-counters" style="background: rgba(0,0,0,0.8); background-position: 0px 175px;" data-stellar-background-ratio="0.5" class="animated">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="white-color size-48">STATS</h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <span class="span-block size-48"><i class="cc ETH-alt" aria-hidden="true"></i></span>
                        <span class="span-block size-64">{{ number_format($site_data['transaction_value'], 2, '.',',') }}</span>
                        <span class="span-block">Total transaction volume (ETH)</span>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <span class="span-block size-48"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                        <span class="span-block size-64">{{ $site_data['active_contracts'] }}</span>
                        <span class="span-block">Active Contracts</span>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <span class="span-block size-48"><i class="fa fa-users" aria-hidden="true"></i></span>
                        <span class="span-block size-64">{{ $site_data['contract_holders'] }}</span>
                        <span class="span-block">Contract Holders</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="fh5co-section fh5co-section-with-bg animated">
        <div class="container">
            <div class="row">


                <div class="col-sm-5 xcol-sm-offset-1 fh5co-section to-animate animated fadeInUp">
                    <img src="{{ asset('./images/transaction-contract-rev2.png') }}" class="img-responsive">
                </div>
                <div class="col-sm-7">
                    <h3>Blockchain meets gaming</h3>
                    <p>Buy, sell, or trade your CryptoCelebrity Smart Contract like it was a traditional collectible using blockchain technology. Bitcoin and ether are cryptocurrencies but CryptoCelebrities are actual cryptocollectibles. Be the only person in the world to own Smart Contracts for well-known personalities such as Angelina Jolie, Leonardo DiCaprio, and Vladimir Putin. The moment you purchase a Smart Contract, it automatically increases up to double in price.
                        Watch out! When someone else matches the current price, they’ll automatically snatch your Smart Contract. You’ll lose the card but you will receive up to double the amount you originally invested in ETH.</p>
                </div>



            </div>
        </div>
    </section>
    <section class="fh5co-section fh5co-section-with-bg animated">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 fh5co-section to-animate text-center fadeInUp animated">
                    <h3>Tutorial</h3>
                    <p></p><div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Xk9HivQsxQk" allowfullscreen=""></iframe>
                    </div>
                    <p></p>
                </div>
                <div class="clearfix visible-sm-block"></div>

            </div>
        </div>
    </section>
    <section class="fh5co-section fh5co-section-with-bg animated">
        <div class="container">
            <div class="row">



                <div class="col-sm-7  fh5co-section to-animate fadeInUp animated">
                    <h3>How it works</h3>
                    <p></p><p>CryptoCelebrities runs on the same blockchain technology as Ethereum. Just like each individual coin, each personality is linked to one, and only one, Smart Contract Token on the game’s blockchain.</p>

                    <p>To purchase a Smart Contract: Send Ether to the contract using Metamask. If someone wants to buy one of your current contracts, the buyer has to pay you more than the amount of your original purchase.</p>

                    <p>To get started, simply download the MetaMask Smart Wallet Google extension. Learn more <a href="https://metamask.io/">here</a>.</p>
                    <p></p>
                </div>
                <div class="col-sm-5 xcol-sm-offset-1 fh5co-section to-animate fadeInUp animated">
                    <img src="{{ asset('./images/how-smart-contracts-work.png') }}" class="img-responsive">
                </div>
                <div class="clearfix visible-sm-block"></div>


            </div>
        </div>
    </section>
    <section class="fh5co-section fh5co-section-with-bg animated">
        <div class="container">
            <div class="row">


                <div class="col-sm-5 xcol-sm-offset-1 fh5co-section to-animate fadeInUp animated">
                    <img src="{{ asset('./images/hard-coded.png') }}" class="img-responsive">
                </div>
                <div class="col-sm-7  fh5co-section to-animate fadeInUp animated">
                    <h3>Value increase is hard coded!</h3>
                    <p></p><p>The price of each contract increases with each transaction. When you buy a Smart Contract, watch out! Anyone can take it away from you by paying up to double what you paid.</p>

                    <p>If you buy a contract for 0.02 ETH, another player can snatch it away from you. Once that happens, you’ll automatically receive 0.04 ETH!</p>

                    <p>Contracts double in price with each transaction until they reach 0.05 ETH.</p>

                    <p>Price increase:</p>

                    <p>2x from 0 ETH to 0.05 ETH, 1.2x from 0.05 ETH to 0.5 ETH and 1.15x from 0.5 ETH up.</p>
                    <p></p>
                </div>



            </div>
        </div>
    </section>
    <section id="fh5co-work" data-section="work" class="animated white-ground">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate fadeInUp animated">Press and Coverage</h2>
                </div>
            </div>
            <div class="row row-bottom-padded-sm">
                <div class="col-md-4 col-sm-6 col-xxs-12">
                    <a href="https://thenextweb.com/distract/2018/01/23/you-can-buy-celebrities-with-ethereum-now/" class="fh5co-project-item to-animate fadeInUp animated" target="_blank" style="height:240px">
                        <img src="{{ asset('./images/logo-tnw.png') }}" class="img-responsive" style="height:30px; margin:30px">
                        <div class="fh5co-text">
                            <h2>You can buy celebrities with Ethereum now</h2>
                            <br>
                            <span>— TNW</span>
                        </div>
                    </a>
                </div>

                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-4 col-sm-6 col-xxs-12">
                    <a href="https://mashable.com/2018/01/23/cryptocelebrities-ethereum-cryptocurrency-celebrities/#Qd0TeQhYisq6" class="fh5co-project-item to-animate fadeInUp animated" target="_blank" style="height:240px">
                        <img src="{{ asset('./images/logo-mashable.png') }}" class="img-responsive" style="height:30px; margin:30px">
                        <div class="fh5co-text">
                            <h2>Cryptocurrency just got more irritating with these new digital celebrity trading cards</h2>
                            <br>
                            <span>— Mashable</span>
                        </div>
                    </a>
                </div>

                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-4 col-sm-6 col-xxs-12">
                    <a href="https://news.bitcoin.com/people-paying-thousands-dollars-crypto-celebrities-blockchain/" class="fh5co-project-item to-animate fadeInUp animated" target="_blank" style="height:240px">
                        <img src="{{ asset('./images/logo-bitcoin.png') }}" class="img-responsive" style="height:30px; margin:30px">
                        <div class="fh5co-text">
                            <h2>People Are Paying Thousands of Dollars for Crypto Celebrities on the Blockchain</h2>
                            <br>
                            <span>— Bitcoin.com</span>
                        </div>
                    </a>
                </div>

                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-4 col-sm-6 col-xxs-12">
                    <a href="https://medium.com/cryptoclarified/how-our-staff-writer-made-52-000-in-3-days-playing-crypto-celebrities-with-ethereum-a4f943a145d8" class="fh5co-project-item to-animate fadeInUp animated" target="_blank" style="height:240px">
                        <img src="{{ asset('./images/logo-crypto-clarified.png') }}" class="img-responsive" style="height:30px; margin:30px">
                        <div class="fh5co-text">
                            <h2>How our Staff Writer Made $52,000 in 3 Days Playing “Crypto Celebrities” with Ethereum</h2>
                            <br>
                            <span>— CryptoClarified</span>
                        </div>
                    </a>
                </div>

                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-4 col-sm-6 col-xxs-12">
                    <a href="https://coinjournal.net/ethereum-cryptocelebrities-game/" class="fh5co-project-item to-animate fadeInUp animated" target="_blank" style="height:240px">
                        <img src="{{ asset('./images/logo-coinjournal.png') }}" class="img-responsive" style="height:30px; margin:30px">
                        <div class="fh5co-text">
                            <h2>New Blockchain Game Lets You Buy And Sell “Celebs Smart Contracts”</h2>
                            <br>
                            <span>— CoinJournal</span>
                        </div>
                    </a>
                </div>

                <div class="clearfix visible-sm-block"></div>
            </div>
        </div>
    </section>
    <footer id="footer" role="contentinfo" >
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-left">
                    <ul>

                        <li><a href="/pages/how-it-works">How it Works</a></li>

                        <li><a href="/pages/faq">FAQ</a></li>

                        <li><a href="/pages/tos">TOS</a></li>

                        <li><a href="/pages/privacy-policy">Privacy Policy</a></li>

                        <li><a href="/pages/legal">Legal &amp; Copyright</a></li>

                        <li><a href="/pages/interest-payments">Interest Payments</a></li>

                    </ul>
                </div>
                <div class="col-md-3 text-left">
                    <ul>

                        <li><a href="/pages/bounty">Bounty Program</a></li>

                        <li><a href="/pages/verified-signup">Verified Signup</a></li>

                        <li><a href="/pages/verified">Verified Contracts</a></li>

                        <li><a href="/pages/contactus">Contact us</a></li>

                        <li><a href="https://discord.gg/fwQKnmd">Chat (Unofficial)</a></li>

                    </ul>
                </div>
                <div class="col-md-3 text-center">
                    <ul class="social social-circle">

                        <li><a href="https://twitter.com/cryptocelebs"><i class="fa fa-twitter"></i></a></li>

                        <li><a href="https://www.facebook.com/cryptocelebrities.co/"><i class="fa fa-facebook"></i></a></li>

                        <li><a href="https://www.instagram.com/crypto_celebrities/"><i class="fa fa-instagram"></i></a></li>

                    </ul>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('./images/ethereum.png') }}" class="img-responsive">
                </div>
            </div>
        </div>

        <br>

        <div class="container">
            <div class="">
                <div class="col-md-12 text-center">
                    <p>Copyright © Crypto Fantasy</p>
                </div>
            </div>
        </div>
    </footer>
</div>

@endsection
