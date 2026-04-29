# Project Guidelines

## Coding Style
- All PHP files must start with `declare(strict_types=1);`.
- All classes must be `final`, except for `abstract` classes and `interfaces`.
- Use `readonly` for classes when all properties are immutable.
- All methods must have explicit return type hints.
- Use constructor property promotion where applicable.
- Use private constructor for all classes in any `Model` namespace.
- Do not always add getter unless needed by code (other than test).
- Favor `is*` or `matches*` methods instead of using getters.
- Test methods must follow the `snake_case` naming convention and start with `test_` (e.g., `public function test_it_should_do_something(): void`).
- Test assertions should be called statically (e.g., `self::assertTrue()` instead of `$this->assertTrue()`).

## Namespace Structure
- The directory under `src/` represents a **Bounded Context** (e.g., `src/Gaming`).
- In `Domain\Model`, use a separate namespace for each **Aggregate type** (e.g., `src/Gaming/Domain/Model/Player`).
- **Aggregate classes** must:
    - Be suffixed with `Aggregate` (e.g., `PlayerAggregate`).
    - Extend `Common\Domain\Model\BaseAggregate`.
- **Identity classes** must:
    - Extend `Common\Domain\Model\BaseIdentity`.
    - Be located within the same namespace as their corresponding Aggregate.

## Workflow Rules
- Always ask for confirmation before performing a code change.
- Do not run tests at each step; the user will run them.
