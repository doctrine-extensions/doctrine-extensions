[![Build Status](https://travis-ci.org/doctrine-extensions/doctrine-extensions.svg?branch=master)](https://travis-ci.org/doctrine-extensions/doctrine-extensions)

## All-New Doctrine Extensions

Welcome to a **new** Doctrine extensions library. :high_brightness:

Our goal is to create a new set of Doctrine extensions and behaviors, based on the
classics [Atlantic18/DoctrineExtensions](https://github.com/Atlantic18/DoctrineExtensions)
and [KnpLabs/DoctrineBehaviors](https://github.com/KnpLabs/DoctrineBehaviors).

##### :warning: This project is under heavy development. Assume no stability at this time.

### Our Goals

- Combine extensions/behaviors, and create a single go-to source for Doctrine goodies
- Rewrite from scratch using modern development practices
- Significantly better documentation
- Monolithic repository with split packages for individual installation (like Symfony components)
- Simplify logic by focusing initially on the 80% need
- Compatibility with Doctrine ORM 3
- Multiple maintainers, at least one dedicated per extension

### Contributing

We are accepting contributors interested in rewriting and maintaining 1-2 extensions.

#### Development Requirements

- Minimum PHP version of 7.2
- Doctrine ORM support only (no MongoDB ODM)
- Annotations mapping support only
- Test all the things!

### Future Goals

These are future priorities that will be dealt with later in development
as a more mature product emerges.

- Semantic versioning, backwards compatibility guarantee
- Coding standards (likely [Doctrine's](https://github.com/doctrine/coding-standard))
- Regular release cycle, possible LTS
- Official framework integration bundles

### What About Existing Users?

We'd like to make the migration to this new package as effortless as possible.
For some, migrating will not be possible (if you are using ODM or a mapping other
than annotations).

For others, we hope that a combination of official framework bundles, beautiful
documentation, and possibly automated tools such as [Rector](https://github.com/rectorphp/rector)
can make updating easy and stable.

First, we need to get a set of extensions working. :smile:

### Extension Usability

|           | Stable | Beta | Alpha              | In development | No progress |
|-----------|--------|------|:------------------:|----------------|-------------|
| Sluggable |        |      | :black_circle:     |                |             |
