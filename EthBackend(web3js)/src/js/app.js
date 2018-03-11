var BigNumber = require('bignumber.js');
App = {
  web3Provider: null,
  contracts: {},
  config: null,
  contractABI: null,
  athleteInstance: {},
  account: null,

  init: function() {
    // Load pets.
    $.getJSON('../config/config.json', function(configJSON){
      App.config = configJSON;
      siteUrl = configJSON.site_url;
      $.getJSON(siteUrl+'/marketplacemenu', function(menu_data){
        menuHTML = '';
        for( i in menu_data ){
          var type = menu_data[i];
          menuHTML += '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'+type.type_name+'</a>';
          team_data = type.team_data;
          if ( team_data.length>=1 ) {
            menuHTML += '<ul class="dropdown-menu multi-column columns-3 marketplace-ul">';
            for( j in team_data ) {
              team = team_data[j];
              menuHTML += '<li><a href="#" id="'+team._id+'" onclick="App.doOnClickTeam(\''+team._id+'\')">'+ team.team_name+'</a></li>';
            }
            menuHTML += '</ul>';
          }

          menuHTML += '</li>';
        }
        $('#top_menu').html(menuHTML);
        console.log(menu_data);
      })
    });
    return App.initWeb3();
  },
  doOnClickTeam: function(_teamId) {
    siteUrl = App.config.site_url;
    $.getJSON(siteUrl+'/viewathlete/'+_teamId, function(data){
      var petsRow = $('#petsRow');
      var petTemplate = $('#petTemplate');
      $('#petsRow').empty();
      for (i = 0; i < data.length; i ++) {
        petTemplate.find('.panel-title').text(data[i].player_name);
        petTemplate.find('img').attr('src', data[i].avatar.replace('..', App.config.api_host));
        petTemplate.find('.pet-price').text(data[i].price);
        petTemplate.find('.pet-owner').text(data[i].owner_name);
        petTemplate.find('.pet-ranking').text(data[i].ranking);
        petTemplate.find('.pet-changes').text(data[i].changes);
        petTemplate.find('.btn-adopt').attr('data-id', data[i]._id);

        petTemplate.find('.panel-body').attr('id', data[i]._id);
        petTemplate.find('.panel-body').attr('originWalletId', data[i].origin_wallet_id);
        petTemplate.find('.panel-body').attr('siteFee', data[i].site_fee);
        petTemplate.find('.panel-body').attr('actualFee', data[i].send_fee);
        petTemplate.find('.panel-body').attr('sellPrice', data[i].price);
        petTemplate.find('.panel-body').attr('tokenId', data[i].token_id);

        if ( data[i].token_id != 'NotAllowed' ) {
          petTemplate.find('.btn-adopt').text('Allowed');
          petTemplate.find('.btn-adopt').attr('disabled', true);
        }
        else{
          petTemplate.find('.btn-adopt').text('Set Allow This Athlete');
          petTemplate.find('.btn-adopt').attr('disabled', false);
        }
        petsRow.append(petTemplate.html());
      }
    });
  },
  getAccount: function() {
    web3.eth.getAccounts(function(error, accounts) {
      if (error) {
        console.log(error);
      }
      App.account = accounts[0];
      $('#span_account').html(App.account);
    });
  },
  initWeb3: function() {
    if ( typeof web3 !== 'undefined' ) {
      App.web3Provider = web3.currentProvider;
    }
    else {
      App.web3Provider = new Web3.providers.HttpProvider(App.config.localhost);
    }
    web3 = new Web3(App.web3Provider);

    return App.initContract();
  },

  initContract: function() {
    $.getJSON('AthleteToken.json', function(AthleteJSON){
      var AthleteArtifact = AthleteJSON;
      App.contracts.Athlete = TruffleContract(AthleteArtifact);

      App.contracts.Athlete.setProvider(App.web3Provider);

      App.contractABI = AthleteJSON.abi;
      console.log(App.contractABI);
      return App.getAthletes();
    });

    App.getAccount();
    return App.bindEvents();
  },

  bindEvents: function() {
    $(document).on('click', '.btn-adopt', App.handleAdopt);
    $(document).on('click', '.btn-purchase', App.handlePurchase);
    $(document).on('click', '.btn-getAthlete-owner', App.handleGetAthleteOwner);
  },

  getAthletes: function() {
    App.contracts.Athlete.deployed().then(function(instance){
      App.athleteInstance = instance;
      return App.athleteInstance.totalSupply.call();
    }).then(function(result){
      var n = new BigNumber(result);
      var _totalAthleteCnt = parseInt(n);
      console.log('Totalsupply is '+n);
      return App.athleteInstance.getAthlete.call(_totalAthleteCnt-1);
      //return App.athleteInstance.getAthlete.call(_totalAthleteCnt-1);
    }).then(function(result){
      var nn = new BigNumber(result[4]);
      console.log(parseFloat(web3.fromWei(nn)), result);
    }).catch(function(err){
      console.log(err);
    });
  },

  handleAdopt: function(event) {
    event.preventDefault();
    var token_id = $(event.target).parent().attr('tokenId');

    var athleteId = $(event.target).parent().attr('id');
    var originWalletId = $(event.target).parent().attr('originWalletId');
    var actualFee = $(event.target).parent().attr('actualFee');
    var siteFee = $(event.target).parent().attr('siteFee');
    var sellPrice = $(event.target).parent().attr('sellPrice');
    var _sellPrice = web3.toWei(sellPrice, 'ether').toString(10);
    web3.eth.getAccounts(function(error, accounts){
      if (error) {
        console.log(error);
      }
      var account = accounts[0];
      App.athleteInstance.createContractOfAthlete(athleteId, originWalletId, actualFee, siteFee, _sellPrice).then(function(result){
        tokenIdInfo = new BigNumber(result.logs[0].args.tokenId);
        token_id = tokenIdInfo.toString();
        siteUrl = App.config.site_url;
        $.getJSON(siteUrl+'/setathletetokenid/'+athleteId+'?token_id='+ token_id, function(resp){

        });
console.log(result);
      }).catch(function(err){
        console.log(err.message);
      });
    });
    // App.athleteInstance.setCEO.call('0x4AA24457A2dfa740116Bd6e801Ce1e69DBB7BF7C');
    console.log(App.athleteInstance);
  },

  handlePurchase : function() {
    var token_id = $(event.target).parent().attr('tokenId');

    var athleteId = $(event.target).parent().attr('id');
    var originWalletId = $(event.target).parent().attr('originWalletId');
    var actualFee = $(event.target).parent().attr('actualFee');
    var siteFee = $(event.target).parent().attr('siteFee');
    var sellPrice = $(event.target).parent().attr('sellPrice');
    var _sellPrice = web3.toWei(sellPrice, 'ether').toString(10);

    App.athleteInstance.purchase(token_id, {
      from:   App.account,
      value:  _sellPrice,
      //gas:    gasLimit
    }).then(function(resp){
      console.log(resp);
    }).catch(function(exp){
      console.log(exp.message);
    });
    console.log(token_id, athleteId, originWalletId, actualFee, siteFee, sellPrice, _sellPrice);
  },
  handleGetAthleteOwner : function() {
    var token_id = $(event.target).parent().attr('tokenId');
    
    // console.log(App.athleteInstance);
    App.athleteInstance.ownerOf.call(token_id).then(function(resp){
      console.log("Owner:",resp);
    }).catch(function(exp){
      console.log(exp.message);
    });
  }

};

$(function() {
  $(window).load(function() {
    App.init();
  });
});
