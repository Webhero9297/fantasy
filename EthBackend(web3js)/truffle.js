const HDWalletProvider = require('truffle-hdwallet-provider');
const fs = require('fs');

const mnemoric = '';

module.exports = {
  // See <http://truffleframework.com/docs/advanced/configuration>
  // for more about customizing your Truffle configuration!
  networks: {
    development: {
      host: "127.0.0.1",
      port: 8545,
      network_id: "dev_net" // Match any network id
    },
    mainnet: {
      network_id: "*",
      gas: 4500000,
      gasPrice: 250000000
    },
    ropsten: {
      provider: new HDWalletProvider(mnemoric, 'https://ropsten.infura.io/', 2),
      network_id: "3",
      gas: 3000000,
      gasPrice: 20000000000
    }
  }
};
