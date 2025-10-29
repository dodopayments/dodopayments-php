# Changelog

## 2.1.1 (2025-10-29)

Full Changelog: [v2.1.0...v2.1.1](https://github.com/dodopayments/dodopayments-php/compare/v2.1.0...v2.1.1)

### Features

* **api:** updated openapi spec to v1.56.3 ([0d88a25](https://github.com/dodopayments/dodopayments-php/commit/0d88a254bfc75e01c3b0015b4f56ff483a63aade))

## 2.1.0 (2025-10-27)

Full Changelog: [v2.0.0...v2.1.0](https://github.com/dodopayments/dodopayments-php/compare/v2.0.0...v2.1.0)

### Features

* **api:** updated to openapi spec v1.56.0 ([4aeeade](https://github.com/dodopayments/dodopayments-php/commit/4aeeade34bdde474ddfac0d761745b7ad0347503))

## 2.0.0 (2025-10-25)

Full Changelog: [v1.55.7...v2.0.0](https://github.com/dodopayments/dodopayments-php/compare/v1.55.7...v2.0.0)

### ⚠ BREAKING CHANGES

* remove confusing `toArray()` alias to `__serialize()` in favour of `toProperties()`

### Features

* **api:** added unwrap functions for webhooks ([53c402b](https://github.com/dodopayments/dodopayments-php/commit/53c402b44cd39d48f56bba425bd4ce882ef01ee9))
* remove confusing `toArray()` alias to `__serialize()` in favour of `toProperties()` ([fff4e65](https://github.com/dodopayments/dodopayments-php/commit/fff4e65beefab2b9de15356364c54826b9d9b890))

## 1.55.7 (2025-10-17)

Full Changelog: [v1.54.0...v1.55.7](https://github.com/dodopayments/dodopayments-php/compare/v1.54.0...v1.55.7)

### ⚠ BREAKING CHANGES

* expose services and service contracts
* use builders for RequestOptions
* rename errors to exceptions
* pagination field rename, and basic streaming docs
* **refactor:** namespacing cleanup
* **refactor:** clean up pagination, errors, as well as request methods

### Features

* **api:** added typescript sdk for migration and updated org info ([0ff81ce](https://github.com/dodopayments/dodopayments-php/commit/0ff81ce033753b457c0ce25ea9d20a618d7d45ec))
* **api:** manual updates ([ac111df](https://github.com/dodopayments/dodopayments-php/commit/ac111df2bdc40a1fcb33d81aa2678725b8f72a24))
* **api:** manual updates ([4899538](https://github.com/dodopayments/dodopayments-php/commit/4899538a3d81d6b576d21418e3140e374e09fcc5))
* **api:** manual updates ([314c164](https://github.com/dodopayments/dodopayments-php/commit/314c1646977563ce44c89c3502d38a0477ef9516))
* **api:** manual updates ([456cef4](https://github.com/dodopayments/dodopayments-php/commit/456cef4fb062a356d93eb5807367e01683fb3cfc))
* **api:** updated code for v1.49.0 ([2f11401](https://github.com/dodopayments/dodopayments-php/commit/2f11401933e80547455caaab6687edb6e9dfc0b0))
* **api:** updated example ([8e831fa](https://github.com/dodopayments/dodopayments-php/commit/8e831fa84b859f2842563b6f19ce7c4f80455cf9))
* **api:** updated openapi spec ([db4e970](https://github.com/dodopayments/dodopayments-php/commit/db4e970fc7b84c96fb0bc7fd5c38f2ad56043cb3))
* **api:** updated openapi spec to v1.51.0 and added checkout sessions ([e3747da](https://github.com/dodopayments/dodopayments-php/commit/e3747dad6edb7e44fb4bb7af764b1c404921202c))
* **api:** updated openapi spec to v1.52.4 ([a41b0fe](https://github.com/dodopayments/dodopayments-php/commit/a41b0fe16f41fc5c5ebf406a2d06174fcfac6f3f))
* **api:** updated openapi spec to v1.53.2 with customer credits. ([796225e](https://github.com/dodopayments/dodopayments-php/commit/796225e56a5db6eb969ffdb655dd33c3ca96d821))
* **api:** updated openapi spec to v1.55.0 ([16061fa](https://github.com/dodopayments/dodopayments-php/commit/16061fac230fcce64edfadfb738521cfc519f411))
* **api:** updates for openapi spec v1.55.7 ([870139f](https://github.com/dodopayments/dodopayments-php/commit/870139f0a910f9849f2b82fafa0c2b7b4018aaab))
* **client:** add raw methods ([33091a7](https://github.com/dodopayments/dodopayments-php/commit/33091a779da533a141ad8f378fbd2b71ce949676))
* **client:** add streaming ([9ac0aba](https://github.com/dodopayments/dodopayments-php/commit/9ac0aba4d3443a834880869d8833620fbf65148a))
* **client:** improve error handling ([bc41da0](https://github.com/dodopayments/dodopayments-php/commit/bc41da0a9cac5598bbf40d4e5225eaa364403299))
* **client:** support raw responses ([9445e26](https://github.com/dodopayments/dodopayments-php/commit/9445e26f77eabc089ff32fad5ff5c5e3968ac2e1))
* **client:** use named parameters in methods ([455b054](https://github.com/dodopayments/dodopayments-php/commit/455b054d3d70dc9e63c96ccb72fa69bfc1112603))
* **client:** use real enums ([84cfbd8](https://github.com/dodopayments/dodopayments-php/commit/84cfbd8617e941b58e4fe6a57ba8383641358368))
* **client:** use with for constructors ([298b248](https://github.com/dodopayments/dodopayments-php/commit/298b248aad82496df82b6be1366a58bf3ddbfb04))
* ensure `-&gt;toArray()` benefits from structural typing ([09d46b8](https://github.com/dodopayments/dodopayments-php/commit/09d46b8006ae333898d602d3551314a3f285f57d))
* expose services and service contracts ([a824cdf](https://github.com/dodopayments/dodopayments-php/commit/a824cdf7fa3aad21a5a20d9454ad0cd81b729d91))
* expose streams and pages in the public namespace ([2b3c319](https://github.com/dodopayments/dodopayments-php/commit/2b3c319d34939c8c870197d95accca3c11d8195d))
* pagination field rename, and basic streaming docs ([a2a6f1b](https://github.com/dodopayments/dodopayments-php/commit/a2a6f1b7a38295202e559b66cb3ffec405e113ce))
* **php:** differentiate null and omit ([bd40b01](https://github.com/dodopayments/dodopayments-php/commit/bd40b0199c46c4a0085181a00040b24e200f0d92))
* **php:** rename internal types ([459c841](https://github.com/dodopayments/dodopayments-php/commit/459c8412f2d84901fe371bec952f54898b58ce42))
* **refactor:** clean up pagination, errors, as well as request methods ([c4d84f9](https://github.com/dodopayments/dodopayments-php/commit/c4d84f924f3fab31d324829513b7601a329f40b7))
* **refactor:** namespacing cleanup ([9c4cbc0](https://github.com/dodopayments/dodopayments-php/commit/9c4cbc033c3299600823c891e8e622ecd5d79187))
* rename errors to exceptions ([9ba6a0e](https://github.com/dodopayments/dodopayments-php/commit/9ba6a0e8945f0ad8e9367b515ab472540ba7df01))
* updated openapi spec and added model and API functions for Usage Based Billing ([7f83f85](https://github.com/dodopayments/dodopayments-php/commit/7f83f85b8d7a8e381786bd1171ca61f409fb5a43))
* use builders for RequestOptions ([fc20ab0](https://github.com/dodopayments/dodopayments-php/commit/fc20ab00e8b98b0490993a8ad23f7ba96789ca95))


### Bug Fixes

* add create release workflow ([b435dcd](https://github.com/dodopayments/dodopayments-php/commit/b435dcddb6454bcd6c6c2a2efe764e15effc913d))
* basic pagination should work ([e861ff5](https://github.com/dodopayments/dodopayments-php/commit/e861ff5c57d5686fadf27c4c4c0150bd6915605d))
* **ci:** release doctor workflow ([30d6d13](https://github.com/dodopayments/dodopayments-php/commit/30d6d13eb75b72f56f123d4a634a0f51ecf4cf6e))
* **client:** elide null named parameters ([4722a21](https://github.com/dodopayments/dodopayments-php/commit/4722a212a8d023467a9bbd5948ef898d4677ec32))
* **client:** properly import fully qualified names ([4a85f31](https://github.com/dodopayments/dodopayments-php/commit/4a85f31b9d1c035dd546dc74fe37ef8646abdef8))
* inverted retry condition ([ea85f3a](https://github.com/dodopayments/dodopayments-php/commit/ea85f3a058088da90859897684c790c038e34da0))
* minor bugs ([a2284e7](https://github.com/dodopayments/dodopayments-php/commit/a2284e7de2a6db1b12d3c86c63c49798b1ec34c8))
* remove inaccurate `license` field in composer.json ([cc13acc](https://github.com/dodopayments/dodopayments-php/commit/cc13accc8b7aeb38b0e76ba2a3a44dd4b0543ff2))
* streaming internals ([742ac0b](https://github.com/dodopayments/dodopayments-php/commit/742ac0bd94684d65996d5ad00d0c64a7c9a55ac0))


### Chores

* add additional php doc tags ([89c8461](https://github.com/dodopayments/dodopayments-php/commit/89c8461cd6e6d592764ad10b1f0b928abd085c15))
* add license ([c31fe12](https://github.com/dodopayments/dodopayments-php/commit/c31fe12f4d29ebe2321f4327354909e39db24932))
* cleanup streaming ([c53640e](https://github.com/dodopayments/dodopayments-php/commit/c53640ede99269771aa284ca68ab12e22902b580))
* **docs:** improve pagination examples ([1836833](https://github.com/dodopayments/dodopayments-php/commit/18368339ab44782919675045adbf97cf0381113f))
* **doc:** small improvement to pagination example ([4ec91ce](https://github.com/dodopayments/dodopayments-php/commit/4ec91ce22358a0f8efd88595e5d4f8db91141e31))
* **docs:** update readme formatting ([feb03ec](https://github.com/dodopayments/dodopayments-php/commit/feb03ece509fbf69d5b56a0e30c4dc68575088ad))
* document parameter object usage ([288df51](https://github.com/dodopayments/dodopayments-php/commit/288df51f56bceeabc3903c12830cc338c4180d9b))
* fix lints in UnionOf ([8040a6a](https://github.com/dodopayments/dodopayments-php/commit/8040a6ad284727eac3771f3c3e6c266b6e3f315a))
* improve model annotations ([e5c64f3](https://github.com/dodopayments/dodopayments-php/commit/e5c64f38305e8752f2a6ebc4adc40326439053ae))
* **internal:** refactor base client internals ([6ad1efe](https://github.com/dodopayments/dodopayments-php/commit/6ad1efefe3ac1555b6fe1f013982caad37b578d1))
* **internal:** refactored internal codepaths ([b879dde](https://github.com/dodopayments/dodopayments-php/commit/b879dde06273b94698479af0f300473b3aa5850d))
* **internal:** remove unnecessary internal aliasing ([89ab0fc](https://github.com/dodopayments/dodopayments-php/commit/89ab0fcab6d665cc1f555127aaadcde1133cb031))
* **internal:** restructure some imports ([d76ca30](https://github.com/dodopayments/dodopayments-php/commit/d76ca305c759df586c4b706c61cda2585731ce77))
* intuitively order union types ([5a6063e](https://github.com/dodopayments/dodopayments-php/commit/5a6063e96f92a32e6abf8b19601fe483654d3492))
* make more targeted phpstan ignores ([9f42db5](https://github.com/dodopayments/dodopayments-php/commit/9f42db5ecc9c47601541a372a5d47619c5d9c7cd))
* readme improvements ([5092584](https://github.com/dodopayments/dodopayments-php/commit/5092584b131ff88387f9f762ef8afaa3773ae9aa))
* refactor methods ([b0608e2](https://github.com/dodopayments/dodopayments-php/commit/b0608e22d8d99e27e4b9fee5bd711c41f21f9a11))
* refactor request options ([8c00327](https://github.com/dodopayments/dodopayments-php/commit/8c00327b51f5a6bb4c2c1e489dbb4a8c9d1a39a1))
* **refactor:** simplify base page interface ([bf012fc](https://github.com/dodopayments/dodopayments-php/commit/bf012fcc469249513acce0b200eb0504cb4c5cde))
* remove `php-http/multipart-stream-builder` as a required dependency ([d85600e](https://github.com/dodopayments/dodopayments-php/commit/d85600eb507eebae8e0fe28765b43635a82eab2b))
* remove type aliases ([389c945](https://github.com/dodopayments/dodopayments-php/commit/389c9457e3d27f3252370ef72b7c43a40c96ef9e))
* simplify model initialization ([53b832b](https://github.com/dodopayments/dodopayments-php/commit/53b832be3e292bc0cf47eb2a1f64efad94f76cb9))
* sync repo ([3e3d0b8](https://github.com/dodopayments/dodopayments-php/commit/3e3d0b86e59bfeb53290771dae5d47ef910e112a))

## 1.54.0 (2025-10-16)

Full Changelog: [v1.53.5...v1.54.0](https://github.com/dodopayments/dodopayments-php/compare/v1.53.5...v1.54.0)

### Features

* **api:** updated openapi spec to v1.55.0 ([ceb3591](https://github.com/dodopayments/dodopayments-php/commit/ceb359179c077af674310e541a4e85f0b84aae5a))

## 1.53.5 (2025-10-11)

Full Changelog: [v1.53.4...v1.53.5](https://github.com/dodopayments/dodopayments-php/compare/v1.53.4...v1.53.5)

### Bug Fixes

* **ci:** release doctor workflow ([38adb51](https://github.com/dodopayments/dodopayments-php/commit/38adb512afd70a66931ba50ef4b5f4ad6a7389b5))
* **client:** properly import fully qualified names ([116eabc](https://github.com/dodopayments/dodopayments-php/commit/116eabc275a87671ced664912f23317a91b409a3))


### Chores

* add license ([dae8941](https://github.com/dodopayments/dodopayments-php/commit/dae89419bd244a1161f7cbad003cc8e3de0b1138))
* **internal:** restructure some imports ([4cd3db5](https://github.com/dodopayments/dodopayments-php/commit/4cd3db5713a25e2f64210190b613932a4ae223c6))
* refactor methods ([410b8fc](https://github.com/dodopayments/dodopayments-php/commit/410b8fc1441584ecf457bcc8b87493991ce3c9ce))

## 1.53.4 (2025-09-23)

Full Changelog: [v1.53.3...v1.53.4](https://github.com/dodopayments/dodopayments-php/compare/v1.53.3...v1.53.4)

### Chores

* **docs:** update readme formatting ([7c4f4aa](https://github.com/dodopayments/dodopayments-php/commit/7c4f4aad04da0c4f13629e548aadffc2690b152d))

## 1.53.3 (2025-09-13)

Full Changelog: [v1.53.2...v1.53.3](https://github.com/dodopayments/dodopayments-php/compare/v1.53.2...v1.53.3)

### Features

* **api:** added typescript sdk for migration and updated org info ([3348900](https://github.com/dodopayments/dodopayments-php/commit/334890023290025fee15fcaec7b633acb4aea6cc))

## 1.53.2 (2025-09-13)

Full Changelog: [v1.53.0...v1.53.2](https://github.com/dodopayments/dodopayments-php/compare/v1.53.0...v1.53.2)

### Features

* **api:** updated openapi spec to v1.53.2 with customer credits. ([4a3006e](https://github.com/dodopayments/dodopayments-php/commit/4a3006e606ee11aa5b5e7c54fa8858cd1604f8c9))

## 1.53.0 (2025-09-13)

Full Changelog: [v1.52.5...v1.53.0](https://github.com/dodopayments/dodopayments-php/compare/v1.52.5...v1.53.0)

### ⚠ BREAKING CHANGES

* expose services and service contracts

### Features

* **client:** add raw methods ([0e4dcfc](https://github.com/dodopayments/dodopayments-php/commit/0e4dcfc13cbeab22bc23a931f674f7ea04581528))
* **client:** support raw responses ([a5352d4](https://github.com/dodopayments/dodopayments-php/commit/a5352d45127f1eca414c90846ba469489578498b))
* **client:** use real enums ([c3d1d9e](https://github.com/dodopayments/dodopayments-php/commit/c3d1d9e49458ad2ae2e87955b5c2efa137abba0f))
* expose services and service contracts ([9ac2730](https://github.com/dodopayments/dodopayments-php/commit/9ac27304b1055ecbeda7938ea602de80debb2490))


### Chores

* cleanup streaming ([155866a](https://github.com/dodopayments/dodopayments-php/commit/155866a630fbc8ca54ea8ff28f93edb8350b061c))
* fix lints in UnionOf ([0993f23](https://github.com/dodopayments/dodopayments-php/commit/0993f2361c3fb7905692337a7f7ae452ad68dfab))
* make more targeted phpstan ignores ([bd27f66](https://github.com/dodopayments/dodopayments-php/commit/bd27f66fb44badb2014dac8d9a243eb47e4689bd))

## 1.52.5 (2025-09-04)

Full Changelog: [v1.52.4...v1.52.5](https://github.com/dodopayments/dodopayments-php/compare/v1.52.4...v1.52.5)

### Features

* **api:** updated openapi spec to v1.52.4 ([d346053](https://github.com/dodopayments/dodopayments-php/commit/d346053b03318b5ff7cf23a30a1e1d9381aa74d7))


### Chores

* document parameter object usage ([8e5584a](https://github.com/dodopayments/dodopayments-php/commit/8e5584a1fe172681646803f012ba2b43698b3bdc))

## 1.52.4 (2025-09-03)

Full Changelog: [v1.52.0...v1.52.4](https://github.com/dodopayments/dodopayments-php/compare/v1.52.0...v1.52.4)

### Features

* **api:** manual updates ([ee8f3d9](https://github.com/dodopayments/dodopayments-php/commit/ee8f3d91e5b05b22e96e40e31f0ef6ae9457634e))
* **api:** updated openapi spec ([d36ee09](https://github.com/dodopayments/dodopayments-php/commit/d36ee093461d2f1f891ae417b65b9cca2e3f3a75))
* updated openapi spec and added model and API functions for Usage Based Billing ([3957896](https://github.com/dodopayments/dodopayments-php/commit/39578962adb40f9d4c70a9f4d304a3b71e4810e1))


### Chores

* **internal:** refactor base client internals ([1fdf181](https://github.com/dodopayments/dodopayments-php/commit/1fdf181396d3863521a2671ee198b4e2dc2c6374))

## 1.52.0 (2025-08-31)

Full Changelog: [v1.51.2...v1.52.0](https://github.com/dodopayments/dodopayments-php/compare/v1.51.2...v1.52.0)

### ⚠ BREAKING CHANGES

* use builders for RequestOptions
* rename errors to exceptions
* pagination field rename, and basic streaming docs
* **refactor:** namespacing cleanup
* **refactor:** clean up pagination, errors, as well as request methods

### Features

* ensure `-&gt;toArray()` benefits from structural typing ([9fd7591](https://github.com/dodopayments/dodopayments-php/commit/9fd759110510d16e5b45ab38d1276c368f9e8ca9))
* expose streams and pages in the public namespace ([ca184e6](https://github.com/dodopayments/dodopayments-php/commit/ca184e6fe2f22155a7462459219d4f9823d14d57))
* pagination field rename, and basic streaming docs ([7c656ef](https://github.com/dodopayments/dodopayments-php/commit/7c656ef44f8259323d014ca53d362336c01537a7))
* **php:** differentiate null and omit ([c30b2a2](https://github.com/dodopayments/dodopayments-php/commit/c30b2a2d7f72c0e864fbb0c60be0d9dbd4bd7354))
* **refactor:** clean up pagination, errors, as well as request methods ([b5d156b](https://github.com/dodopayments/dodopayments-php/commit/b5d156b934b45e055d0acef9c3a20afc3b400e26))
* **refactor:** namespacing cleanup ([58301aa](https://github.com/dodopayments/dodopayments-php/commit/58301aac437fe7cfd00e158c37f26d47b5f62d96))
* rename errors to exceptions ([a86ba15](https://github.com/dodopayments/dodopayments-php/commit/a86ba15629a396bc6687eec392f240383d99254d))
* use builders for RequestOptions ([3efa4d8](https://github.com/dodopayments/dodopayments-php/commit/3efa4d8cdcdbd70194c0fcbc3b7ea35eccb23af5))


### Bug Fixes

* add create release workflow ([ce1f19d](https://github.com/dodopayments/dodopayments-php/commit/ce1f19d44b06a3517e8a4722c215035b2d671201))
* basic pagination should work ([7d0495e](https://github.com/dodopayments/dodopayments-php/commit/7d0495ef5db5038db60b9a31bce94706a264f74e))
* minor bugs ([7d39df1](https://github.com/dodopayments/dodopayments-php/commit/7d39df102ae3daf6ff5c66d795fd8d0c84fe9a26))
* remove inaccurate `license` field in composer.json ([3468353](https://github.com/dodopayments/dodopayments-php/commit/3468353ebce5ec9236aabf037f5bacc87c16847f))
* streaming internals ([6b92fef](https://github.com/dodopayments/dodopayments-php/commit/6b92fef752349de8d649d60deefbb265a78450b2))


### Chores

* add additional php doc tags ([7630e19](https://github.com/dodopayments/dodopayments-php/commit/7630e19c31d7091d30855b3f00069432f34d56d5))
* **docs:** improve pagination examples ([0d136a9](https://github.com/dodopayments/dodopayments-php/commit/0d136a96ded76df3ea6a6fe71f6b58f49ff883b8))
* **doc:** small improvement to pagination example ([c80cca7](https://github.com/dodopayments/dodopayments-php/commit/c80cca700b0a505a7b10efb986122cf2b1c526a1))
* **internal:** refactored internal codepaths ([9ed7c0e](https://github.com/dodopayments/dodopayments-php/commit/9ed7c0e4bc40d509e060018efa55b3192be61c1e))
* refactor request options ([5d8abaf](https://github.com/dodopayments/dodopayments-php/commit/5d8abaf9fcd49fb13af9dc2445cda8a49ac4c66b))
* **refactor:** simplify base page interface ([3bf4be5](https://github.com/dodopayments/dodopayments-php/commit/3bf4be5393c3e3a02eefacd53c6273b03c0cc4f3))
* remove `php-http/multipart-stream-builder` as a required dependency ([602e6f4](https://github.com/dodopayments/dodopayments-php/commit/602e6f4c0e91160e5ecf5c6f4501355dc8a8f82f))
* simplify model initialization ([d69f077](https://github.com/dodopayments/dodopayments-php/commit/d69f077179e856749473d88ed349b7195a288368))

## 1.51.2 (2025-08-24)

Full Changelog: [v1.51.1...v1.51.2](https://github.com/dodopayments/dodopayments-php/compare/v1.51.1...v1.51.2)

### Chores

* improve model annotations ([a351dd4](https://github.com/dodopayments/dodopayments-php/commit/a351dd4d5fa68c4a58b48c344d43f5c0e4a611d5))

## 1.51.1 (2025-08-23)

Full Changelog: [v1.51.0...v1.51.1](https://github.com/dodopayments/dodopayments-php/compare/v1.51.0...v1.51.1)

### Chores

* remove type aliases ([05256ab](https://github.com/dodopayments/dodopayments-php/commit/05256abfaee0e4669d92c0ac9f5ef558c3c5923d))

## 1.51.0 (2025-08-22)

Full Changelog: [v1.50.1...v1.51.0](https://github.com/dodopayments/dodopayments-php/compare/v1.50.1...v1.51.0)

### Features

* **api:** updated example ([6ae6c1f](https://github.com/dodopayments/dodopayments-php/commit/6ae6c1f00cd8bff4894c11aca96530bfecc4fec2))
* **api:** updated openapi spec to v1.51.0 and added checkout sessions ([b558561](https://github.com/dodopayments/dodopayments-php/commit/b5585611d87014131550619f3132ce2e1ac20df7))

## 1.50.1 (2025-08-21)

Full Changelog: [v1.50.0...v1.50.1](https://github.com/dodopayments/dodopayments-php/compare/v1.50.0...v1.50.1)

### Features

* **client:** add streaming ([88c4cfc](https://github.com/dodopayments/dodopayments-php/commit/88c4cfc93111ed59f1b14cd63ccd9633e794db88))
* **client:** improve error handling ([517d392](https://github.com/dodopayments/dodopayments-php/commit/517d3921fca8921dba641bfed933b4b0b9a47109))
* **client:** use named parameters in methods ([17793c2](https://github.com/dodopayments/dodopayments-php/commit/17793c2690b5b57dc2254bd7cc01ad4ffca0ccfc))
* **php:** rename internal types ([bb0a969](https://github.com/dodopayments/dodopayments-php/commit/bb0a969990ee5729920dd185b7f0f644a9928dc2))


### Bug Fixes

* **client:** elide null named parameters ([d11f74e](https://github.com/dodopayments/dodopayments-php/commit/d11f74e0c353f942e12690d7a3c13cdeba917aea))


### Chores

* intuitively order union types ([c5deaae](https://github.com/dodopayments/dodopayments-php/commit/c5deaae1de00a2b8718e033342ae7fea3e7a0d8c))
* readme improvements ([9449090](https://github.com/dodopayments/dodopayments-php/commit/944909087c9359a2502c7468d23204b283f1bd48))

## 1.50.0 (2025-08-19)

Full Changelog: [v1.49.0...v1.50.0](https://github.com/dodopayments/dodopayments-php/compare/v1.49.0...v1.50.0)

### Features

* **api:** manual updates ([b67b956](https://github.com/dodopayments/dodopayments-php/commit/b67b9561ffee0daa8c0597b638f0a0aa74cfda9f))
* **api:** manual updates ([0ba6c67](https://github.com/dodopayments/dodopayments-php/commit/0ba6c677a0af25cad05ca8fe91f376a840ff5e26))
* **api:** manual updates ([50176b0](https://github.com/dodopayments/dodopayments-php/commit/50176b0c2f2036d63889fc312cad5d077bb8fc52))
* **client:** use with for constructors ([570e8ed](https://github.com/dodopayments/dodopayments-php/commit/570e8ed9a99c40abcdcf0bb75c260b74b132da24))


### Chores

* **internal:** remove unnecessary internal aliasing ([e2a183a](https://github.com/dodopayments/dodopayments-php/commit/e2a183a5f65a03e7bbe2ebf5c82c5c22b4547ad6))

## 1.49.0 (2025-08-13)

Full Changelog: [v1.47.1...v1.49.0](https://github.com/dodopayments/dodopayments-php/compare/v1.47.1...v1.49.0)

### Features

* **api:** updated code for v1.49.0 ([0b3adc3](https://github.com/dodopayments/dodopayments-php/commit/0b3adc3443e4ea27705c816f29020834bad0a3d0))

## 1.47.1 (2025-08-13)

Full Changelog: [v0.0.1...v1.47.1](https://github.com/dodopayments/dodopayments-php/compare/v0.0.1...v1.47.1)

### Chores

* sync repo ([39a3de0](https://github.com/dodopayments/dodopayments-php/commit/39a3de0b795b75eecf9c7dc0dbfa3e55fd9ed7bc))
