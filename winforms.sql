USE [master]
GO
/****** Object:  Database [WinFormsDB]    Script Date: 4/6/2021 10:48:55 PM ******/
CREATE DATABASE [WinFormsDB]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'WinFormsDB', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\WinFormsDB.mdf' , SIZE = 5120KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'WinFormsDB_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\WinFormsDB_log.ldf' , SIZE = 2048KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [WinFormsDB] SET COMPATIBILITY_LEVEL = 120
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [WinFormsDB].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [WinFormsDB] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [WinFormsDB] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [WinFormsDB] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [WinFormsDB] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [WinFormsDB] SET ARITHABORT OFF 
GO
ALTER DATABASE [WinFormsDB] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [WinFormsDB] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [WinFormsDB] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [WinFormsDB] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [WinFormsDB] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [WinFormsDB] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [WinFormsDB] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [WinFormsDB] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [WinFormsDB] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [WinFormsDB] SET  DISABLE_BROKER 
GO
ALTER DATABASE [WinFormsDB] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [WinFormsDB] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [WinFormsDB] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [WinFormsDB] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [WinFormsDB] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [WinFormsDB] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [WinFormsDB] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [WinFormsDB] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [WinFormsDB] SET  MULTI_USER 
GO
ALTER DATABASE [WinFormsDB] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [WinFormsDB] SET DB_CHAINING OFF 
GO
ALTER DATABASE [WinFormsDB] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [WinFormsDB] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [WinFormsDB] SET DELAYED_DURABILITY = DISABLED 
GO
USE [WinFormsDB]
GO
/****** Object:  Table [dbo].[mesto]    Script Date: 4/6/2021 10:48:55 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[mesto](
	[mestoID] [int] IDENTITY(1,1) NOT NULL,
	[naziv] [varchar](50) NULL,
	[postanskiBroj] [int] NULL,
 CONSTRAINT [PK_mesto] PRIMARY KEY CLUSTERED 
(
	[mestoID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[radnoMesto]    Script Date: 4/6/2021 10:48:55 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[radnoMesto](
	[radnoMestoID] [int] IDENTITY(1,1) NOT NULL,
	[pozicija] [varchar](50) NULL,
	[strucnaSprema] [varchar](50) NULL,
	[radnoIskustvo] [varchar](50) NULL,
 CONSTRAINT [PK_radnoMesto] PRIMARY KEY CLUSTERED 
(
	[radnoMestoID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[zaposleni]    Script Date: 4/6/2021 10:48:55 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[zaposleni](
	[zaposleniID] [int] IDENTITY(1,1) NOT NULL,
	[ime] [varchar](50) NULL,
	[prezime] [varchar](50) NULL,
	[godRodjenja] [varchar](50) NULL,
	[bracniStatus] [varchar](50) NULL,
	[radnoMestoID] [int] NULL,
	[mestoID] [int] NULL,
 CONSTRAINT [PK_zaposleni] PRIMARY KEY CLUSTERED 
(
	[zaposleniID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[mesto] ON 

INSERT [dbo].[mesto] ([mestoID], [naziv], [postanskiBroj]) VALUES (1, N'Cacak', 32222)
INSERT [dbo].[mesto] ([mestoID], [naziv], [postanskiBroj]) VALUES (2, N'Kragujevac', 65444)
INSERT [dbo].[mesto] ([mestoID], [naziv], [postanskiBroj]) VALUES (5, N'Gornji Milanovac', 34422)
SET IDENTITY_INSERT [dbo].[mesto] OFF
SET IDENTITY_INSERT [dbo].[radnoMesto] ON 

INSERT [dbo].[radnoMesto] ([radnoMestoID], [pozicija], [strucnaSprema], [radnoIskustvo]) VALUES (1, N'Fronted web developer', N'Strukovne studije', N'Nije obavezno')
INSERT [dbo].[radnoMesto] ([radnoMestoID], [pozicija], [strucnaSprema], [radnoIskustvo]) VALUES (2, N'Java Developer', N'Akademske studije', N'Obavezno')
INSERT [dbo].[radnoMesto] ([radnoMestoID], [pozicija], [strucnaSprema], [radnoIskustvo]) VALUES (3, N'Android Developer', N'Akademske studije', N'Nije obavezno')
INSERT [dbo].[radnoMesto] ([radnoMestoID], [pozicija], [strucnaSprema], [radnoIskustvo]) VALUES (6, N'WordPress developer', N'Strukovne studije', N'Nije obavezno')
INSERT [dbo].[radnoMesto] ([radnoMestoID], [pozicija], [strucnaSprema], [radnoIskustvo]) VALUES (7, N'Senior C# developer', N'Master studije', N'Obavezno')
INSERT [dbo].[radnoMesto] ([radnoMestoID], [pozicija], [strucnaSprema], [radnoIskustvo]) VALUES (8, N'Full Stack Software Engineer', N'Akademske studije', N'Obavezno')
INSERT [dbo].[radnoMesto] ([radnoMestoID], [pozicija], [strucnaSprema], [radnoIskustvo]) VALUES (9, N'Software Tester', N'Master studije', N'Nije obavezno')
SET IDENTITY_INSERT [dbo].[radnoMesto] OFF
SET IDENTITY_INSERT [dbo].[zaposleni] ON 

INSERT [dbo].[zaposleni] ([zaposleniID], [ime], [prezime], [godRodjenja], [bracniStatus], [radnoMestoID], [mestoID]) VALUES (5, N'Ana', N'Milenkovic', N'1987-10-14', N'U braku', 1, 1)
INSERT [dbo].[zaposleni] ([zaposleniID], [ime], [prezime], [godRodjenja], [bracniStatus], [radnoMestoID], [mestoID]) VALUES (7, N'Milena', N'Filipovic', N'1979-06-03', N'U braku', 3, 1)
INSERT [dbo].[zaposleni] ([zaposleniID], [ime], [prezime], [godRodjenja], [bracniStatus], [radnoMestoID], [mestoID]) VALUES (8, N'Ivan ', N'Zaric', N'1996-05-21', N'Nije u braku', 8, 2)
INSERT [dbo].[zaposleni] ([zaposleniID], [ime], [prezime], [godRodjenja], [bracniStatus], [radnoMestoID], [mestoID]) VALUES (9, N'Julijana', N'Marinkovic', N'1991-09-11', N'U braku', 9, 5)
INSERT [dbo].[zaposleni] ([zaposleniID], [ime], [prezime], [godRodjenja], [bracniStatus], [radnoMestoID], [mestoID]) VALUES (10, N'Nikola', N'Petrovic', N'1997-01-08', N'Nije u braku', 7, 2)
SET IDENTITY_INSERT [dbo].[zaposleni] OFF
ALTER TABLE [dbo].[zaposleni]  WITH CHECK ADD  CONSTRAINT [FK_zaposleni_mesto] FOREIGN KEY([mestoID])
REFERENCES [dbo].[mesto] ([mestoID])
GO
ALTER TABLE [dbo].[zaposleni] CHECK CONSTRAINT [FK_zaposleni_mesto]
GO
ALTER TABLE [dbo].[zaposleni]  WITH CHECK ADD  CONSTRAINT [FK_zaposleni_radnoMesto] FOREIGN KEY([radnoMestoID])
REFERENCES [dbo].[radnoMesto] ([radnoMestoID])
GO
ALTER TABLE [dbo].[zaposleni] CHECK CONSTRAINT [FK_zaposleni_radnoMesto]
GO
USE [master]
GO
ALTER DATABASE [WinFormsDB] SET  READ_WRITE 
GO
