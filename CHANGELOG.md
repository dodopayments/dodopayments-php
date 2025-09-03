# Changelog

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
