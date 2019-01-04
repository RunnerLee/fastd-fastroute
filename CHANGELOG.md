# ChangeLog for fastd fractal

## [1.0.1] - 2018-05-09
### Changed
- uncasting null to empty string


## [1.0.4] - 2018-05-25
### Added
- Fractal 增加 transformer() 方法及 manager() 方法
- 增加 AbstractTransformer, 重写 item() / collection() / primitive()


## [2.0.0] - 2018-06-12
### Added
- 增加 Fractal::transformer() 静态方法

### Changed
- fractal() 辅助函数改为创建 Fractal 实例

### Removed
- 移除 FractalServiceProvider


## [2.0.1] - 2018-06-13
### Fixed
- 修复一处小 bug
