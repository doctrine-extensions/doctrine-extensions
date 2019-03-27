# Doctrine Extensions Architecture

## Targeted Compatibility

- PHP >= 7.2
- Doctrine ORM 2.6+, 3.0 (no ODM / MongoDB - ORM only)
- Doctrine Annotations Driver only

## File Structure

Doctrine Extensions consists of a single [monorepo](https://gomonorepo.org), that is
automatically split into multiple read-only repositories for individual installation.

Inside [`src`](../src) are three primary directories:

1. [`Common`](../src/Common): common files required for any/all extensions to function.
   Foundational files to support all extensions, hooks into Doctrine's functionality, etc.
   
2. [`Extension`](../src/Extension): the individual extensions, e.g. [Sluggable](../src/Extension/Sluggable)

3. [`Tests`](../src/Tests): Common test utilities

## Metadata

At the source of any Doctrine project is
[metadata](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/metadata-drivers.html#metadata-drivers).

Doctrine Extensions uses a custom Annotation driver to parse entities for their configuration.
The resulting [metadata class](../src/Common/Metadata/ExtendedClassMetadata.php) holds
the information needed for each extension to perform.

> :rotating_light: Doctrine Extensions **only supports Annotations** at this time.
> You can any type of mapping for your doctrine configuration, but extensions can only be mapped with annotations.

## Lifecycle

#### Configuration

The following happens during Doctrine's "bootstrap" configuration.

1. Doctrine is configured to use a custom Annotation metadata driver and
   custom class metadata factory
2. Each active extension registers necessary event listeners on the Event Manager

#### Metadata

The Annotation driver will simultaneously fetch the standard ORM class metadata
and the metadata for each active extension.

#### Event Listeners

Active extensions will often hook into typical Doctrine
[lifecycle events](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/events.html#reference-events-lifecycle-events)
such as `prePersist`. This is crucial to providing automatic functionality based
only on Annotation metadata.

Which events exactly will depend on the extension and the functionality it provides.
