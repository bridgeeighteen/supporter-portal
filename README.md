<div id="top"></div>

<div align="center">
  <a href="https://codeberg.org/bridgeeighteen/supporter-portal">
    <img src="public/assets/images/logo.svg" alt="十八桥社区" height="60">
  </a>

<h3 align="center">支持者门户</h3>

  <p align="center">
    十八桥社区为支持者打造的门户，基于 Bootstrap 和 PHP。
    <br />
    <br />
    <a href="https://codeberg.org/bridgeeighteen/supporter-portal/issues">反馈 Bug </a>
    ·
    <a href="https://codeberg.org/bridgeeighteen/supporter-portal/issues">请求新功能</a>
    <br />
    <br />
    <img src="https://img.shields.io/gitea/pull-requests/all/bridgeeighteen/supporter-portal?gitea_url=https%3A%2F%2Fcodeberg.org" alt="PR 总数">
    <img src="https://img.shields.io/gitea/stars/bridgeeighteen/supporter-portal?gitea_url=https%3A%2F%2Fcodeberg.org" alt="Stars 总数">
    <img src="https://img.shields.io/gitea/issues/all/bridgeeighteen/supporter-portal?gitea_url=https%3A%2F%2Fcodeberg.org" alt="Issues 总数">
    <img src="https://img.shields.io/packagist/v/bridgeeighteen/supporter-portal" alt="Composer 版本">
  </p>
</div>

<!-- 目录 -->
<details>
  <summary>目录</summary>
  <ol>
    <li>
      <a href="#关于本项目">关于本项目</a>
      <ul>
        <li><a href="#构建工具">构建工具</a></li>
      </ul>
    </li>
    <li>
      <a href="#开始">开始</a>
      <ul>
        <li><a href="#依赖">依赖</a></li>
        <li><a href="#正常安装（生产环境推荐）">正常安装</a></li>
        <li><a href="#使用Git克隆安装">使用 Git 克隆安装</a></li>
      </ul>
    </li>
    <li><a href="#主要功能">主要功能</a></li>
    <li><a href="#贡献">贡献</a></li>
    <li><a href="#许可证">许可证</a></li>
    <li><a href="#联系我们">联系我们</a></li>
  </ol>
</details>

<!-- 关于本项目 -->
## 关于本项目

这是十八桥社区为支持者准备的门户，用于为支持者提供支持者卡核验等服务。

<p align="right">(<a href="#top">回到顶部</a>)</p>

### 构建工具

* [Composer](https://getcomposer.org)
* [Bootstrap](https://getbootstrap.com/)

<p align="right">(<a href="#top">回到顶部</a>)</p>

<!-- 开始 -->
## 开始

要获取本地副本并且配置运行，你可以按照下面的示例步骤操作。

### 依赖

* Composer
* MySQL / MariaDB
* PHP 8.1 及以上
* Nginx / Apache
* NTAG21x 芯片 / 遵循 NFC Forum Tag Type 1 标准的支持者卡
* ATNFC 系列卡片读写器（电脑网页读卡必需，可以在[淘宝](https://item.taobao.com/item.htm?id=1060203712046)购买）

### 正常安装（生产环境推荐）

1. 创建一个全新的 MySQL / MariaDB 数据库，记住服务器地址（如果端口不一样还要记端口）、数据库名称、用户名及其密码。注意字符集应为 `utf8mb4_unicode_ci`。

2. 通过 Composer 创建新项目。这里的 `my-new-project` 可以根据实际需要更换。在网站目录执行创建时，需要确保面板等自动生成的文件已经删除，否则会出错。

   ```shell
   composer create-project bridgeeighteen/supporter-portal my-new-project
   ```

3. 在 `.env.example` 中设置网站路径（`SITE_URL`）、配置数据库（`DB_*`）和调整日志级别（`LOG_LEVEL`） ，完成后重命名为 `.env`，然后在 `config/app.php` 中设置站点名称（`site_name`）和配置“更多链接”区域（`links`）。

4. 使用 phpMyAdmin 等导入 `schema.sql` 中定义的数据表及结构。

5. 在 `cards` 表中手工录入支持者卡信息。

6. 设置 Nginx / Apache 的运行目录为 `/public`。

7. 将以下链接写入支持者卡中：

   ```plaintext
   https://<服务域名>/card-rd.php?uide=<卡片十六进制 UID>&read=<NTAG 为 02，T1T 为 08>&from=inside
   ```

### 使用 Git 克隆安装

1. 创建一个全新的 MySQL / MariaDB 数据库，记住服务器地址（如果端口不一样还要记端口）、数据库名称、用户名及其密码。注意字符集应为 `utf8mb4_unicode_ci`。

2. 克隆本仓库。

   ```shell
   git clone https://codeberg.org/bridgeeighteen/supporter-portal.git
   ```

3. 安装 Composer 依赖包。

   ```shell
   composer install
   ```

4. 在 `.env.example` 中设置网站路径（`SITE_URL`）、配置数据库（`DB_*`）和调整日志级别（`LOG_LEVEL`） ，完成后重命名为 `.env`，然后在 `config/app.php` 中设置站点名称（`site_name`）和配置“更多链接”区域（`links`）。

5. 使用 phpMyAdmin 等导入 `schema.sql` 中定义的数据表及结构。

6. 在 `cards` 表中手工录入支持者卡信息。

7. 设置 Nginx / Apache 的运行目录为 `/public`。

8. 将以下链接写入支持者卡中：

   ```plaintext
   https://<服务域名>/card-rd.php?uide=<卡片十六进制 UID>&read=<NTAG 为 02，T1T 为 08>&from=inside
   ```

<p align="right">(<a href="#top">回到顶部</a>)</p>


<!-- 主要功能 -->
## 主要功能

- [x] 支持者卡线上读取、验证
- [ ] 基于支持者卡的 OAuth
- [ ] 共建基金信息公开可视化

你也可以到 [Open Issues](https://codeberg.org/bridgeeighteen/supporter-portal/issues) 页查看所有请求的功能（以及已知的问题）。

<p align="right">(<a href="#top">回到顶部</a>)</p>

<!-- 贡献 -->
## 贡献

贡献让开源社区成为了一个非常适合学习、互相激励和创新的地方。你所做出的任何贡献都是**受人尊敬**的。

如果你有好的建议，请复刻（Fork）本仓库并且创建一个拉取请求（Pull Request）。你也可以简单地创建一个议题（Issue），并且添加标签「enhancement」。不要忘记给项目点一个 Star！再次感谢！

1. 复刻（Fork）本项目
2. 创建你的 Feature 分支 (`git checkout -b feature/AmazingFeature`)
3. 提交你的变更 (`git commit -m 'Add some amazing feature'`)
4. 推送到该分支 (`git push origin feature/AmazingFeature`)
5. 创建一个拉取请求（Pull Request）

<p align="right">(<a href="#top">回到顶部</a>)</p>

<!-- 许可证 -->
## 许可证

根据 AGPL-3.0-or-later 许可证分发。AGPL-3.0 的完整副本请见 [LICENSE](LICENSE)。

<p align="right">(<a href="#top">回到顶部</a>)</p>

<!-- 联系我们 -->
## 联系我们

Matrix：[#community:millions.bridge18.qzz.io](https://matrix.to/#/#community:millions.bridge18.qzz.io)

<p align="right">(<a href="#top">回到顶部</a>)</p>
